@extends('master')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Buscar Horario</b></div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Action</th>
            </tr>
            @if (count($horarios) > 0)
                @foreach ($horarios as $horario)
                    <tr>
                        <td>{{ $horario->id }}</td>
                        <td>{{ $horario->descripcion }}</td>
                        <td>
                            <a href="{{ route('turno.horario.seleccionar', [$turno_choose, $horario->id]) }}" class="btn btn-primary btn-sm">Seleccionar</a>
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