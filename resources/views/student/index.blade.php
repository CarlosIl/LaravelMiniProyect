@extends('master')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>Student Data</b></div>
                @if (auth()->user()->type == 'admin')
                    <div class="col col-md-6">
                        <a href="{{ route('students.create') }}" class="btn btn-success btn-sm float-end">Add</a>
                        <a href="generate-pdf" class="btn btn-info btn-sm float-end">Generar PDF</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if (auth()->user()->type == 'admin')
                @php($actions = true)
                {!! $students->links() !!}
            @else
                @php($actions = false)
            @endif

            @include('student.table')
        </div>
    </div>
@endsection
