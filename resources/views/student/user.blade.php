@extends('master')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>Student Data</b></div>
            </div>
        </div>
        <div class="card-body">
            @php($actions = false)
            @include('student.table')
        </div>
    </div>
@endsection
