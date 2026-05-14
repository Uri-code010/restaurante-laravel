<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platillo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Orden;
use App\Models\DetalleOrden;

class PedidoController extends Controller
{
    // 1. Agregar platillos a la memoria (Sesión)
    public function agregar(Request $request, $id)
    {
        $platillo = Platillo::findOrFail($id);
        $pedido = session()->get('pedido', []);
        $cantidad = $request->input('cantidad', 1);

        // Si ya está en el pedido, le sumamos la cantidad; si no, lo creamos
        if(isset($pedido[$id])) {
            $pedido[$id]['cantidad'] += $cantidad;
        } else {
            $pedido[$id] = [
                "nombre" => $platillo->nombre,
                "cantidad" => $cantidad,
                "precio" => $platillo->precio,
            ];
        }

        session()->put('pedido', $pedido);
        return redirect()->back()->with('success', '¡' . $platillo->nombre . ' agregado a tu pedido!');
    }

    // 2. Ver el resumen del pedido antes de confirmar
    public function ver()
    {
        $pedido = session()->get('pedido', []);
        $total = 0;

        foreach($pedido as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('pedido.index', compact('pedido', 'total'));
    }

    // 3. Generar el Ticket Final y Guardar en BD
    public function ticket()
    {
        $pedido = session()->get('pedido', []);

        if(empty($pedido)) {
            return redirect('/menu')->with('error', 'Tu pedido está vacío.');
        }

        // 1. Crear la Orden usando el modelo de tu compañero
        $orden = Orden::create([
            'user_id' => Auth::id(),
            'estado' => 'pendiente',
            'total' => 0, // Lo calcularemos en el loop
        ]);

        $totalCalculado = 0;

        // 2. Crear los detalles de la orden
        foreach($pedido as $platillo_id => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];

            DetalleOrden::create([
                'orden_id' => $orden->id,
                'platillo_id' => $platillo_id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'subtotal' => $subtotal,
            ]);

            $totalCalculado += $subtotal;
        }

        // 3. Actualizar el total final de la orden
        $orden->total = $totalCalculado;
        $orden->save();

        // Guardamos datos para la vista del ticket y limpiamos sesión
        $ticket = $pedido;
        $total = $totalCalculado;
        $numeroOrden = $orden->id;
        session()->forget('pedido');

        return view('pedido.ticket', compact('ticket', 'total', 'numeroOrden'));
    }
}
