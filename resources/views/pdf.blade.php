
<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ventas</title>
    <img src="public/images/OIP.jpg" alt="Logo Reportes" class="h-6 w-6" />
    
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas</h2>
    <table>
        <thead>
            <tr>
                <th>Nr</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $venta->cliente_nombre }}</td>
                <td>{{ $venta->total }}</td>
                <td>{{ $venta->fecha_registro }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>suma total:{{number_format($total, 2)}}</h3>
</body>
</html>