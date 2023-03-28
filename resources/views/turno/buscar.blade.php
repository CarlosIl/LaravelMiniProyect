@extends('master')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Buscar Turno</b></div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Action</th>
            </tr>
            @if (count($turnos) > 0)
                @foreach ($turnos as $turno)
                    <tr>
                        <td>{{ $turno->id }}</td>
                        <td>{{ $turno->descripcion }}</td>
                        <td>
                            <a href="{{ route('turno.seleccionar', $turno->id) }}" class="btn btn-primary btn-sm">Seleccionar</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No Data Found</td>
                </tr>
            @endif
        </table>
        <form method="post" action="{{ route('turno.busqueda') }}" enctype="multipart/form-data">
            @csrf
			<div class="row mb-3">
                <div class="col-sm-2">
					<select name="buscarPor">
                        <option value="id">Código</option>
                        <option value="descripcion">Descripción</option>
                    </select>
				</div>
				<div class="col-sm-5">
					<input type="text" name="loBuscado" class="form-control"/>
				</div>
                <div class="col-sm-1">
					<button type="submit" title="Buscar Turno" class="btn btn-secondary btn-sm float-end rounded-circle"><span class="material-symbols-outlined">search</span></button>
				</div>
			</div>
        </form>
    </div>
</div>

@endsection('content')