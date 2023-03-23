@extends('master')

@section('content')
    <div class="card">
        <div class="card-header">Descargar fichero</div>
        <div class="card-body">
            <form method="post" action="{{ route('downFile') }}" enctype="multipart/form-data">
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
        </div>
    </div>
@endsection('content')