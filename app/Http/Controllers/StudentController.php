<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Categoria;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::latest()->paginate(5);
        $categorias = Categoria::all();

        return view('student/index', compact('data','categorias'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            // 'student_image'         =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        // $file_name = time() . '.' . request()->student_image->getClientOriginalExtension();

        // request()->student_image->move(public_path('images'), $file_name);

        $student = new Student;

        $student->student_name = $request->student_name;
        $student->student_email = $request->student_email;
        $student->student_gender = $request->student_gender;
        $student->id_categoria = $request->id_categoria;
        // $student->student_image = $file_name;

        $student->save();

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
        $categorias = Categoria::all();
        return view('student/show', compact('student','categorias'));
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

        // $new_student_image = "images/{$student->student_image}";
        // unlink($new_student_image);

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student Data deleted successfully');
    }
}
