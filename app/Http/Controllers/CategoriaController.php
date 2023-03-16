<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Categoria::all();

        return view('categoria/todos_cat', compact('data'));
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

        $categoria = new Categoria();

        $categoria->descripcion = $request->descripcion;

        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Se añadido la nueva categoría.');
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
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'descripcion'          =>  'required|unique:categorias',
        ]);

        $categoria = Categoria::find($request->hidden_id);

        $categoria->descripcion = $request->descripcion;

        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'La categoría ha sido editada correctamente');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'La categoría ha sido eliminada');
    }
}
