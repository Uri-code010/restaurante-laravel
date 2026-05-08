<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\Platillo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenController extends Controller
{
    // Cliente: crear orden
    public function store(Request $request)
    {
        $orden = Orden::create([
            'user_id' => Auth::id(),
            'estado' => 'pendiente',
            'total' => 0,
        ]);

        $total = 0;

        foreach ($request->platillos as $platillo_id => $cantidad) {
            $platillo = Platillo::findOrFail($platillo_id);
            $subtotal = $platillo->precio * $cantidad;

            DetalleOrden::create([
                'orden_id' => $orden->id,
                'platillo_id' => $platillo->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $platillo->precio,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $orden->total = $total;
        $orden->save();

        return redirect()->route('orden.mis')->with('success','Orden creada correctamente');
    }

    // Cliente: ver sus órdenes
    public function misOrdenes()
    {
        $ordenes = Orden::where('user_id', Auth::id())
            ->with('detalles.platillo')
            ->get();

        return view('ordenes.mis', compact('ordenes'));
    }

    // Cocinero: ver todas las órdenes
    public function index()
    {
        $ordenes = Orden::with('usuario','detalles.platillo')->get();
        return view('ordenes.index', compact('ordenes'));
    }

    // Cocinero: cambiar estado
    public function cambiarEstado($id)
    {
        $orden = Orden::findOrFail($id);

        if ($orden->estado === 'pendiente') {
            $orden->estado = 'en_preparacion';
        } elseif ($orden->estado === 'en_preparacion') {
            $orden->estado = 'lista';
        }

        $orden->save();
        return redirect()->route('orden.index')->with('success','Estado actualizado');
    }

    // Cocinero: ver detalle de orden
    public function show($id)
    {
        $orden = Orden::with('usuario','detalles.platillo')->findOrFail($id);
        return view('ordenes.show', compact('orden'));
    }
}
