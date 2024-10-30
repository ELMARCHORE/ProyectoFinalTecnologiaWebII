<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante de Compra</title>
    <style>
        /* Estilos para el PDF */
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            color: #333;
            background-color: #f4f4f9;
        }
        .header, .footer { 
            text-align: center; 
            background-color: #FF9800; /* Naranja */
            color: white;
            padding: 10px 0;
        }
        .content { 
            margin: 20px; 
            padding: 20px;
            background-color: white; 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h3 { 
            margin: 0;
            padding: 0;
        }
        .header h1 {
            font-size: 1.8em;
            margin-bottom: 0;
        }
        .header p {
            margin-top: 5px;
        }
        .customer-info, .purchase-details {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
        }
        th, td { 
            border: 1px solid #FF9800; /* Bordes en naranja */
            padding: 12px; 
            text-align: left; 
        }
        th {
            background-color: #FF9800; /* Fondo del encabezado en naranja */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
            padding-top: 10px;
        }
        .footer p {
            font-size: 0.9em;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Comprobante de Compra</h1>
        <p>Número: {{ $comprobante->numero }} | Fecha: {{ $comprobante->fecha }}</p>
    </div>

    <div class="content">
        <h3>Datos del Cliente</h3>
        <div class="customer-info">
            <p><strong>Nombre:</strong> {{ $comprobante->cliente->nombre }} {{ $comprobante->cliente->apellidos }}</p>
            <p><strong>Correo:</strong> {{ $comprobante->cliente->correo }}</p>
            <p><strong>Celular:</strong> {{ $comprobante->cliente->celular }}</p>
            <p><strong>Dirección:</strong> {{ $comprobante->cliente->direccion }}</p>
        </div>

        <h3>Detalles de la Compra</h3>
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->descripcion }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ number_format($detalle->punitario, 2) }}</td>
                        <td>{{ number_format($detalle->importe, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p>Total: {{ number_format($comprobante->total, 2) }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Gracias por su compra</p>
        <p>&copy; {{ date('Y') }} Mi Tienda Tecnologia Web II
            [Wilson Lima-
            Luis Elmar-
            Renato-
            Luis Visitor-
            Nick Brandon]. Todos los derechos reservados.</p>
    </div>
</body>
</html>
