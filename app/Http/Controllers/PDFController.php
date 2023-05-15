<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Student;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $students = Student::get();
        $categorias = Categoria::get();

        $data = [
            'students' => $students,
            'categorias' => $categorias
        ];

        $pdf = PDF::loadView('student/myPDF', $data);

        return $pdf->download('students.pdf');
    }

    public function generateDiploma(String $nombre)
    {
        // $request->validate([
        //     'nombre'          =>  'required',
        // ]);

        $data = [
            'nombre' => $nombre,
            'fecha' => now()->format('d-m-Y H:m:s')
        ];
        // return $data;

        $pdf =  PDF::loadView('diploma', $data)->setPaper('a4', 'landscape');
        return $pdf->download('diploma.pdf');

        // return view('diploma', compact('data'));
    }
}
