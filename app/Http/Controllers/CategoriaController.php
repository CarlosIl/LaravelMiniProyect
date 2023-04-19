<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Categoria;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(!Auth::check()){
        //     return redirect('/login');
        // }

        $data = Categoria::all();

        return $this->sendResponse($data, 'Categorias retrieved successfully');
        // return view('categoria/todos_cat', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria/addCategoria');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion'          =>  'required|unique:categorias',
        ]);

        // if($request->fails()){
        //     return $this->sendError('Validation Error.', $request->errors());
        // }

        $categoria = new Categoria();

        $categoria->descripcion = $request->descripcion;

        $categoria->save();

        return $this->sendResponse($categoria, 'Categoría creada');
        // return redirect()->route('categorias.index')->with('success', 'Se añadido la nueva categoría.');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categoria/updateCategoria', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'descripcion'          =>  'required|unique:categorias',
        ]);

        // if($request->fails()){
        //     return $this->sendError('Validation Error.', $request->errors());
        // }

        $categoria = Categoria::find($request->hidden_id);

        $categoria->descripcion = $request->descripcion;

        $categoria->save();

        return $this->sendResponse($categoria, 'Categoría actualizada');
        // return redirect()->route('categorias.index')->with('success', 'La categoría ha sido editada correctamente');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Categoria $categoria)
    {
        $sql = DB::select('SELECT count(*) as total FROM students WHERE id_categoria = ?',[$categoria->id]);
        $students_with_categoria = intval($sql[0]->total);
        
        if ($students_with_categoria == 0) {
            $categoria->delete();

            return $this->sendResponse([], 'Categoría eliminada');
            // return redirect()->route('categorias.index')->with('success', 'La categoría ha sido eliminada');
        }else{
            return $this->sendError('Error.', "La categoria esta siendo usada $students_with_categoria veces");
            // return redirect()->route('categorias.index')->with('error', "ERROR: La categoria esta siendo usada $students_with_categoria veces");
        }
    }

    public function show()
    {
        # code...
    }
}
