@extends('master')

@section('content')

<div class="card">
	<div class="card-header">Edit Student</div>
	<div class="card-body">
		<form method="post" action="{{ route('createFile', $student->id) }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Student Image</label>
				<div class="col-sm-10">
					<input type="file" name="student_image" class="form-control"/>
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $student->id }}" />
				<input type="submit" class="btn btn-primary" value="Edit" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')