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
    </div>
</div>

@endsection('content')