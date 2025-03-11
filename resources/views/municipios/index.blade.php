<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Municipios</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Municipios</h1>
        <a href="{{ route('municipios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Municipio</a>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Código Postal</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($municipios as $municipio)
                <tr>
                    <td class="border px-4 py-2">{{ $municipio->nombre }}</td>
                    <td class="border px-4 py-2">{{ $municipio->cp }}</td>
                    <td class="border px-4 py-2">{{ $municipio->estado_nombre }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('municipios.show', $municipio->id) }}" class="bg-green-500 text-white px-2 py-1 rounded">Ver</a>
                        <a href="{{ route('municipios.edit', $municipio->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                        <form action="{{ route('municipios.destroy', $municipio->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>