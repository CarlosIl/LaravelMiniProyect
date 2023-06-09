@extends('master')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    {{ $message }}
</div>
@elseif($message = Session::get('error'))
<div class="alert alert-danger">
    {{ $message }}
</div>
@endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>Categorias</b></div>
                <div class="col col-md-6">
                    <a href="{{ route('categorias.create') }}" class="btn btn-success btn-sm float-end">Add</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
                @if (count($response) > 0)
                    @foreach ($response['data'] as $row)
                        <tr>
                            <td>{{ $row['id'] }}</td>
                            <td>{{ $row['descripcion'] }}</td>
                            
                            <td>
                                <form method="post" action="{{ route('categorias.destroy', $row['id']) }}">
                                <form>
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('categorias.edit', $row['id']) }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    <input type="submit" class="btn btn-danger btn-sm" value="Eliminar" />
                                </form>

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

@endsection
