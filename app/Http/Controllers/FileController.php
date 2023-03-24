<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\StudentFiles;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Student $student)
    {
        return view('student/file/index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Student $student)
    {
        return view('student/file/add', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Student $student)
    {
        $request->validate([
            'student_file'         =>  'nullable|file|max:41943040'
        ]);

        $student = Student::find($request->hidden_id);
        $path = $student->student_ftp_path;

        if ($request->hasFile('student_file')) {
            // $file_name = request()->student_image->getClientOriginalName() . '_' . time() . '.' . request()->student_image->getClientOriginalExtension();
            $file_name = time() . '_' . request()->student_file->getClientOriginalName();

            try {
                Storage::disk("ftp")->makeDirectory($path);
                Storage::disk("ftp")->put($file_name, fopen($request->file('student_file'), 'r+'));
            } catch (\Throwable $th) {
                Storage::disk("sftp")->put("$path/$file_name", fopen($request->file('student_file'), 'r+'));
            }

            $file = new StudentFiles;

            $file->file_name = $file_name;
            $file->id_student = $student->id;
    
            $file->save();
        }

        return redirect()->route('students.index')->with('success', 'El fichero ha sido añadido correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $ficherosStd = DB::select('SELECT id,file_name FROM `student_files` WHERE id_student = ?',[$student->id]);
        $ficheros = json_decode(json_encode($ficherosStd), true);

        return view('student/file/download', compact('ficheros','student'));
    }

    public function download(Request $request,Student $student)
    {
        $id = $request->fichero;

        $student = Student::find($request->hidden_id);
        $path = $student->student_ftp_path;

        $file = StudentFiles::find($id);
        $file_name = $file->file_name;

        try {
            Storage::disk("ftp")->makeDirectory($path);
            return Storage::disk('ftp')->download($file_name);
        } catch (\Throwable $th) {
            return Storage::disk('sftp')->download("$path/$file_name");
        }


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function delete(Student $student)
    {
        //$ficheros = Storage::disk('ftp')->files($student->student_ftp_path);
        $ficherosStd = DB::select('SELECT id,file_name FROM `student_files` WHERE id_student = ?',[$student->id]);
        $ficheros = json_decode(json_encode($ficherosStd), true);

        return view('student/file/delete', compact('ficheros','student'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Student $student)
    {
        $id = $request->fichero;

        $student = Student::find($request->hidden_id);
        $path = $student->student_ftp_path;

        $file = StudentFiles::find($id);
        $file_name = $file->file_name;

        try {
            Storage::disk("ftp")->makeDirectory($path);
            Storage::disk("ftp")->delete($file_name);
        } catch (\Throwable $th) {
            Storage::disk("sftp")->delete("$path/$file_name");
        }

        $file->delete();

        return redirect()->route('students.index')->with('success', 'El fichero se ha eliminado satisfactoriamente');
    }
}
