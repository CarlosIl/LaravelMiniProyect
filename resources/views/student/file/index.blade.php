@extends('master')

@section('content')

@if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Ficheros de {{ $student->student_name }}</b></div>
			<div class="col col-md-6">
				<a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm float-end">Volver</a>
			</div>
		</div>
	</div>
	<div class="card-body">
    	<a href="{{ route('files.show', $student->id) }}" class="btn btn-primary btn-sm">Download Files</a>
        <a href="{{ route('files.create', $student->id) }}" class="btn btn-warning btn-sm">Add Files</a>
		<a href="{{ route('files.delete', $student->id) }}" class="btn btn-danger btn-sm">Delete Files</a>
	</div>
</div>

@endsection('content')