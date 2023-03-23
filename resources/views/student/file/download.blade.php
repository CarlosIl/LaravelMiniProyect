@extends('master')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>Descargar fichero</b></div>
                <div class="col col-md-6">
                    <a href="{{ route('files.index', $student->id) }}" class="btn btn-secondary btn-sm float-end">Volver</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($ficheros == null)
                <h5>No hay ningún ficheros almacenados</h5>
            @else
                <form method="post" action="{{ route('files.download') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <label class="col-sm-2 col-label-form">Elige el fichero</label>
                        <div class="col-sm-10">
                            <select name="fichero">
                                @foreach ($ficheros as $fichero)
                                    <option value="{{ $fichero["id"] }}">{{ $fichero["file_name"] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="hidden" name="hidden_id" value="{{ $student->id}}" />
                        <input type="submit" class="btn btn-primary" value="Descargar" />
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection('content')