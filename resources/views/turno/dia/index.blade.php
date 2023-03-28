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
		<form method="post" action="{{ route('turno.dia.crear', $turno_choose) }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Número Día</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" value="{{$diaNuevo}}" disabled/>
					<input type="hidden" name="dia" class="form-control" value="{{$diaNuevo}}"/>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Horario</label>
				<div class="col-sm-1">
					@if($mostrar_horario)
					<input type="number" class="form-control" value="{{$horario_choose->id}}" disabled/>
					<input type="hidden" name="id_horario" class="form-control" value="{{$horario_choose->id}}"/>
					@else
					<input type="number" name="id_horario" class="form-control" disabled/>
					@endif
				</div>
                <div class="col-sm-1">
					<a href="{{ route('turno.horario', $turno_choose) }}" title="Buscar Horario" class="btn btn-primary btn-sm float-end rounded-circle"><span class="material-symbols-outlined">search</span></a>
				</div>
                <div class="col-sm-8">
					@if($mostrar_horario)
                    <input type="text" class="form-control" value="{{$horario_choose->descripcion}}" disabled/>
					@else
                    <input type="text" class="form-control" disabled/>
					@endif
                </div>
			</div>
			<div class="text-center">
				@if($mostrar_horario)
				<input type="hidden" name="id_turno" value="{{ $turno_choose->id }}" />
				<input type="submit" class="btn btn-primary" value="Añadir" />
				@endif
			</div>	
		</form>
	</div>
</div>
{{-- @dd($horario_choose) --}}

@endsection('content')