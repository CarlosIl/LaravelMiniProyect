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
	<div class="card-header"><b>Día</b></div>
	<div class="card-body">
		<form method="post" action="{{ route('turno.crear') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Número Día</label>
				<div class="col-sm-10">
					<input type="number" name="id_turno" class="form-control" value="{{$diaNuevo}}" disabled/>
				</div>

			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Horario</label>
				<div class="col-sm-1">
					<input type="text" name="descripcion" class="form-control" />
				</div>
                <div class="col-sm-1">
					<a href="{{ route('turno.horario') }}" class="btn btn-secondary btn-sm float-end"><span class="material-symbols-outlined">search</span></a>
				</div>
                <div class="col-sm-8">
                    <input type="text" name="descripcion" class="form-control" value="{{$turno_choose->descripcion}}" disabled/>
                </div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Añadir" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')