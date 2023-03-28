<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Días</b></div>
            <div class="col col-md-6">
                <a href="{{ route('turno.dia', $turno_choose->id) }}" title="Añadir Día" class="btn btn-success btn-sm float-end rounded-circle"><span class="material-symbols-outlined">description</span></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Día</th>
                <th>Horario</th>
                <th>Descripción</th>
            </tr>
            @if (count($dias) > 0)
                @foreach ($dias as $dia)
                    <tr>
                        <td>{{ $dia['dia'] }}</td>
                        <td>{{ $dia['id_horario'] }}</td>
                        <td>{{ $dia['descripcion'] }}</td>
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
