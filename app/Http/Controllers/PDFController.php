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
}
