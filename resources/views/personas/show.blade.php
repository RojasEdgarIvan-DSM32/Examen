<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Detalles de Persona</h1>
        <div class="bg-white p-4 rounded shadow">
            <p><strong>Nombre:</strong> {{ $persona->nombre }}</p>
            <p><strong>Dirección:</strong> {{ $persona->direccion }}</p>
            <p><strong>Foto:</strong></p>
            <img src="{{ asset('storage/' . $persona->foto) }}" alt="Foto" class="w-32 h-32">
            <p><strong>Municipio:</strong> {{ $persona->municipio_nombre }}</p>
            <p><strong>Estado:</strong> {{ $persona->estado_nombre }}</p>
        </div>
        <a href="{{ route('personas.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Volver</a>
    </div>
</body>
</html>