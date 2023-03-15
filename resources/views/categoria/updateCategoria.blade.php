@extends('master')

@section('content')

<div class="card">
	<div class="card-header">Editar Categoría</div>
	<div class="card-body">
		<form method="post" action="{{ route('categorias.update', $categoria->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Descripción</label>
				<div class="col-sm-10">
					<input type="text" name="descripcion" class="form-control" value="{{ $categoria->descripcion }}" />
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $categoria->id }}" />
				<input type="submit" class="btn btn-primary" value="Editar" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')