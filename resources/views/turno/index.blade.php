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

{{-- @if ($mostrar_dias)
	@dd($dias)
@endif --}}

<div class="card">
	<div class="card-header"><b>Turno</b></div>
	<div class="card-body">
		<form method="post" action="{{ route('turno.crear') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Código</label>
				<div class="col-sm-9">
					@if($mostrar_dias)
					<input type="number" name="id_turno" class="form-control" value="{{$turno_choose->id}}" disabled/>
					@else
					<input type="number" name="id_turno" class="form-control" />
					@endif
				</div>
				<div class="col-sm">
					<a href="{{ route('turno.buscar') }}" class="btn btn-secondary btn-sm float-end"><span class="material-symbols-outlined">search</span></a>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Descripción</label>
				<div class="col-sm-10">
					@if($mostrar_dias)
					<input type="text" name="descripcion" class="form-control" value="{{$turno_choose->descripcion}}" disabled/>
					@else
					<input type="text" name="descripcion" class="form-control" />
					@endif
				</div>
			</div>
			<div class="text-center">
				@if(!$mostrar_dias)
				<input type="submit" class="btn btn-primary" value="Añadir" />
				@endif
			</div>	
		</form>
	</div>
</div>

@if ($mostrar_dias)
	<br>
	{{-- @php
		$diasStd = DB::select('SELECT dia, horarios.id_horario, horarios.descripcion FROM lineas_turnos JOIN horarios ON lineas_turnos.id_horario = horarios.id_horario WHERE id_turno = ?',[$turno_choose->id]);
        $dias = json_decode(json_encode($diasStd), true);
	@endphp --}}
	@include('turno.dias')
@endif


@endsection('content')