<table class="table table-bordered">
    <tr>
        {{-- <th>Image</th> --}}
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Categoria</th>
        @if ($actions)
            <th>Action</th>
        @endif
    </tr>
    @if (count($students) > 0)
        @foreach ($students as $student)
            <tr>
                {{-- <td><img src="{{ asset('images/' . $row->student_image) }}" width="75" /></td> --}}
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->student_email }}</td>
                <td>{{ $student->student_gender }}</td>

                @foreach ($categorias as $categoria)
                    @if ($categoria->id == $student->id_categoria)
                        <td>{{ $categoria->descripcion }}</td>
                    @endif
                @endforeach

                @if ($actions)
                    <td>
                        <form method="post" action="{{ route('students.destroy', $student->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('addFile', $student->id) }}" class="btn btn-secondary btn-sm">Add File</a>
                            <a href="{{ route('studentfiles.edit', $student->id) }}" class="btn btn-dark btn-sm">Delete File</a>
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" class="text-center">No Data Found</td>
        </tr>
    @endif
</table>
