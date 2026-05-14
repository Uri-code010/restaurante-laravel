<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Consumo</title>
    <!-- Fuente monoespaciada para estilo de impresora térmica -->
    <style>
        body { font-family: 'Courier New', Courier, monospace; background-color: #f4f4f4; padding: 20px; }
        .ticket {
            background-color: #fff; width: 300px; margin: 0 auto; padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 1px solid #ddd;
        }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 22px; }
        .header p { margin: 2px 0; font-size: 12px; }
        .divisor { border-top: 1px dashed #000; margin: 15px 0; }
        .item { display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 5px; }
        .total { display: flex; justify-content: space-between; font-weight: bold; font-size: 16px; margin-top: 15px; }
        .footer { text-align: center; font-size: 12px; margin-top: 20px; }

        /* Ocultar el botón al imprimir */
        @media print {
            .no-print { display: none; }
            body { background-color: #fff; }
            .ticket { box-shadow: none; border: none; width: 100%; }
        }

        .btn-imprimir {
            display: block; width: 300px; margin: 20px auto; padding: 10px;
            background-color: #E76F51; color: white; border: none; border-radius: 5px;
            font-size: 16px; cursor: pointer; font-weight: bold; font-family: sans-serif;
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="no-print btn-imprimir">Imprimir / Guardar PDF</button>

    <div class="ticket">
        <div class="header">
            <h2>COFFEE DREAMS</h2>
            <p>Ticket de Consumo</p>
            <p>Fecha: {{ date('d/m/Y H:i') }}</p>
        </div>

        <div class="divisor"></div>

        <div class="items">
            <div class="item" style="font-weight: bold;">
                <span>CANT x PROD</span>
                <span>SUB</span>
            </div>
            <div class="divisor" style="margin: 5px 0 15px 0;"></div>

            @foreach($ticket as $item)
                <div class="item">
                    <span>{{ $item['cantidad'] }}x {{ $item['nombre'] }}</span>
                    <span>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                </div>
            @endforeach
        </div>

        <div class="divisor"></div>

        <div class="total">
            <span>TOTAL:</span>
            <span>${{ number_format($total, 2) }}</span>
        </div>

        <div class="footer">
            <p>¡Gracias por tu preferencia!</p>
            <p>Vuelve pronto</p>
        </div>
    </div>

    Orden #{{ $numeroOrden }}

    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <a href="/menu" style="color: #333; text-decoration: none; font-family: sans-serif;">Volver al Menú</a>
    </div>

</body>
</html>
