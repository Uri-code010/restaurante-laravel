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
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $categoria = $request->input('categoria');

        $platillos = Platillo::when($buscar, function ($query, $buscar) {
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                ->orWhere('categoria', 'like', "%$buscar%");
            });
        })
        ->when($categoria, function ($query, $categoria) {
            $query->where('categoria', $categoria);
        })
        ->paginate(5);

        $categorias = Platillo::select('categoria')->distinct()->pluck('categoria');

        return view('platillos.index', compact('platillos', 'buscar', 'categoria', 'categorias'));
    }

    /**
     * Display the public menu for clients.
     */
    public function menuPublico(Request $request)
    {
        // 1. Recibimos lo que el cliente escriba en la barra de búsqueda
        $buscar = $request->input('buscar');
        $categoria = $request->input('categoria');

        // 2. Buscamos en la base de datos
        $platillos = Platillo::when($buscar, function ($query, $buscar) {
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                  ->orWhere('descripcion', 'like', "%$buscar%");
            });
        })
        ->when($categoria, function ($query, $categoria) {
            $query->where('categoria', $categoria);
        })
        ->paginate(9); // Mostramos 9 tarjetas por página para que se vea lleno

        // 3. Obtenemos las categorías para el filtro
        $categorias = Platillo::select('categoria')->distinct()->pluck('categoria');

        // 4. Retornamos la NUEVA vista (que crearemos en el paso 2)
        return view('platillos.menu', compact('platillos', 'buscar', 'categoria', 'categorias'));
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
        try {

        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:1',
            'categoria' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string',
        ]);

        Platillo::create($request->all());

        return redirect()->route('platillos.index')
            ->with('success', 'Platillo guardado correctamente.');

        } catch (\Exception $e) {

            return back()->with('error', 'Ocurrió un error al guardar.');
        }
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
        try {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:1',
            'categoria' => 'required|string|max:50',
        ]);


        $platillo = Platillo::findOrFail($id);


        $platillo->update($request->all());


        return redirect()->route('platillos.index')
            ->with('success', 'Platillo actualizado correctamente.');

        } catch (\Exception $e) {

            return back()->with('error', 'Ocurrió un error al actualizar.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {


        $platillo = Platillo::findOrFail($id);
        $platillo->delete();


        return redirect()->route('platillos.index')
            ->with('success', 'Platillo eliminado correctamente.');

        } catch (\Exception $e) {

            return back()->with('error', 'Ocurrió un error al eliminar.');
        }
    }
}
