<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Categoria;
use App\Models\StudentFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!Auth::check()){
        //     return redirect('/login');
        // }
        
        $students = Student::latest()->paginate(10);
        $categorias = Categoria::all();

        return view('student/index', compact('students','categorias'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        
        return view('student/create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name'          =>  'required',
            'student_email'         =>  'required|email|unique:students',
            'student_file'         =>  'nullable|file'
            // 'student_image'         =>  'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        // request()->student_image->move(public_path('images'), $file_name);

        $path = request()->student_email;

        $student = new Student;

        $student->student_name = $request->student_name;
        $student->student_email = $request->student_email;
        $student->student_gender = $request->student_gender;
        $student->id_categoria = $request->id_categoria;
        // $student->student_image = $file_name;
        $student->student_ftp_path = $path;

        $student->save();

        try {
            Storage::disk('ftp')->makeDirectory($path);
        } catch (\Throwable $th) {
            Storage::disk('sftp')->makeDirectory($path);
        }

        if ($request->hasFile('student_file')) {
            $file_name = time() . '_' . request()->student_file->getClientOriginalName();
            try {
                Storage::disk('ftp')->makeDirectory($path);
                Storage::disk('ftp')->put("$file_name", fopen($request->file('student_file'), 'r+'));
            } catch (\Throwable $th) {
                Storage::disk('sftp')->put("$path/$file_name", fopen($request->file('student_file'), 'r+'));
            }

            $file = new StudentFiles;

            $file->file_name = $file_name;
            $file->id_student = $student->id;
    
            $file->save();
        }

        return redirect()->route('students.index')->with('success', 'Student Added successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // $ficheros = DB::select('SELECT file_name FROM `student_files` WHERE id_student = ?',[$student->id]);
        // $ficheros = intval($sql[0]->total);

        // $ficheros = Storage::disk('ftp')->files($student->student_ftp_path);
        // $ficheros_final = [];
        // foreach ($ficheros as $fichero){
        //     $file = Storage::disk('ftp')->get($fichero);
        //     $ficheros_final[] = $file;
        // };

        $ficherosStd = DB::select('SELECT id,file_name FROM `student_files` WHERE id_student = ?',[$student->id]);
        $ficheros = json_decode(json_encode($ficherosStd), true);

        $categorias = Categoria::all();
        return view('student/show', compact('student','categorias','ficheros'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $categorias = Categoria::all();
        return view('student/edit', compact('student','categorias'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_name'      =>  'required',
            'student_email'     =>  'required|email',
            // 'student_image'     =>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        // $student_image = $request->hidden_student_image;

        // if($request->student_image != '')
        // {
        //     $student_image = time() . '.' . request()->student_image->getClientOriginalExtension();

        //     request()->student_image->move(public_path('images'), $student_image);
        // }

        $student = Student::find($request->hidden_id);

        $student->student_name = $request->student_name;

        $student->student_email = $request->student_email;

        $student->student_gender = $request->student_gender;

        $student->id_categoria = $request->id_categoria;

        // $student->student_image = $student_image;


        $path = $student->student_ftp_path;
        $new_path = $request->student_email;

        try {
            Storage::disk("ftp")->move($path, $new_path);
        } catch (\Throwable $th) {
            Storage::disk("sftp")->move($path, $new_path);
        }

        $student->student_ftp_path = $new_path;

        $student->save();

        return redirect()->route('students.index')->with('success', 'El estudiante ha sido editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // Para eliminar imagen o fichero en Laravel Storage
        // $new_student_image = "images/{$student->student_image}";
        // unlink($new_student_image);
        $sql = DB::select('SELECT count(*) as total FROM student_files WHERE id_student = ?',[$student->id]);
        $ficheros_con_students = intval($sql[0]->total);
        
        if ($ficheros_con_students == 0) {
            $path = $student->student_ftp_path;

            try {
                Storage::disk("ftp")->deleteDirectory($path);
            } catch (\Throwable $th) {
                Storage::disk("sftp")->deleteDirectory($path);
            }

            $student->delete();
    
            return redirect()->route('students.index')->with('success', 'Student Data deleted successfully');
        }else{

            return redirect()->route('students.index')->with('error', "ERROR: Este usuario tiene $ficheros_con_students documentos en su directorio");
        }


    }

    public function indexUser()
    {
        // if(!Auth::check()){
        //     return view('auth.login');
        // }

        $students = Student::get();
        $categorias = Categoria::get();

        return view('student/index', compact('students','categorias'));
    }

}
