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
	<div class="card-header"><b>Editar Turno</b></div>
	<div class="card-body">
		<form method="post" action="{{ route('turno.actualizar') }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Código</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" value="{{$turno_choose->id}}" disabled/>
					<input type="hidden" name="id" class="form-control" value="{{$turno_choose->id}}"/>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Descripción</label>
				<div class="col-sm-10">
					<input type="text" name="descripcion" class="form-control" value="{{$turno_choose->descripcion}}"/>
				</div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Editar" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')