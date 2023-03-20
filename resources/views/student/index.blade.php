@extends('master')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>Student Data</b></div>
                <div class="col col-md-6">
                    <a href="{{ route('students.create') }}" class="btn btn-success btn-sm float-end">Add</a>
                    <a href="generate-pdf" class="btn btn-info btn-sm float-end">Generar PDF</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @php($actions = true)
            @include('student.table')
            {!! $students->links() !!}
        </div>
    </div>

@endsection
