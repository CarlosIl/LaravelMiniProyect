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
			<div class="col col-md-6"><b>Añadir fichero</b></div>
			<div class="col col-md-6">
				<a href="{{ route('files.index', $student->id) }}" class="btn btn-secondary btn-sm float-end">Volver</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<form method="post" action="{{ route('files.store', $student->id) }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Elige un fichero</label>
				<div class="col-sm-10">
					<input type="file" name="student_file" class="form-control"/>
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $student->id }}" />
				<input type="submit" class="btn btn-primary" value="Añadir" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')