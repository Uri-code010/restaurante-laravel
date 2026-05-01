<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlatilloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platillos = Platillo::all();
        return view('platillos.index', compact('platillos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('platillos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'categoria' => 'required',
        ]);

        Platillo::create($request->all());

        return redirect('/platillos')->with('success', 'Platillo agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Platillo $platillo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $platillo = Platillo::findOrFail($id);
        return view('platillos.edit', compact('platillo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
         'nombre' => 'required',
         'precio' => 'required|numeric',
         'categoria' => 'required'
    ]);

        $platillo = Platillo::findOrFail($id);
        $platillo->update($request->all());

        return redirect('/platillos')->with('success', 'Platillo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $platillo = Platillo::findOrFail($id);
        $platillo->delete();

        return redirect('/platillos')->with('success', 'Platillo eliminado');
    }
}
