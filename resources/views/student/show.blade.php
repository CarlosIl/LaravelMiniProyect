@extends('master')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>Student Details</b></div>
                <div class="col col-md-6">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Student Name</b></label>
                <div class="col-sm-10">
                    {{ $student->student_name }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form"><b>Student Email</b></label>
                <div class="col-sm-10">
                    {{ $student->student_email }}
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>Student Gender</b></label>
                <div class="col-sm-10">
                    {{ $student->student_gender }}
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>Categoria</b></label>
                <div class="col-sm-10">
                    @foreach ($categorias as $categoria)
                        @if ($categoria->id == $student->id_categoria)
                            {{ $categoria->descripcion }}
                        @endif
                    @endforeach
                </div>
            </div>
            {{-- <div class="row mb-4">
                <label class="col-sm-2 col-label-form"><b>Student Image</b></label>
                @foreach ($ficheros as $fichero)
                <div class="col-sm-10">
                    <a href="{{ route('descargar', ['fichero' => $fichero])}}" class="btn btn-primary btn-sm">Descargar {{$fichero}}</a>
                </div>
                @endforeach
            </div> --}}
        </div>
    </div>
@endsection('content')
