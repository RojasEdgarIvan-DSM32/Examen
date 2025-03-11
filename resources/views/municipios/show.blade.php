<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Municipio</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Detalles de Municipio</h1>
        <div class="bg-white p-4 rounded shadow">
            <p><strong>Nombre:</strong> {{ $municipio->nombre }}</p>
            <p><strong>Código Postal:</strong> {{ $municipio->cp }}</p>
            <p><strong>Estado:</strong> {{ $municipio->estado_nombre }}</p>
        </div>
        <a href="{{ route('municipios.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Volver</a>
    </div>
</body>
</html>