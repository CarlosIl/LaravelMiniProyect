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
	<div class="card-header">Añadir Categoría</div>
	<div class="card-body">
		<form method="post" action="{{ route('categorias.store') }}">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Descripción</label>
				<div class="col-sm-10">
					<input type="text" name="descripcion" class="form-control" />
				</div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Añadir" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')