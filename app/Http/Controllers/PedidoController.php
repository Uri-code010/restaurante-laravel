<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platillo;

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

    // 3. Generar el Ticket Final
    public function ticket()
    {
        $pedido = session()->get('pedido', []);

        if(empty($pedido)) {
            return redirect('/menu')->with('error', 'Tu pedido está vacío.');
        }

        $total = 0;
        foreach($pedido as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // Guardamos los datos para el ticket y vaciamos el pedido actual para el siguiente cliente
        $ticket = $pedido;
        session()->forget('pedido');

        return view('pedido.ticket', compact('ticket', 'total'));
    }
}
