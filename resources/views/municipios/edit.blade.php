<!-- resources/views/municipios/edit.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Municipio</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Municipio</h1>
        <form action="{{ route('municipios.update', $municipio->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ $municipio->nombre }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="cp" class="block text-sm font-medium text-gray-700">Código Postal</label>
                <input type="text" name="cp" id="cp" value="{{ $municipio->cp }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="estado_id" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="estado_id" id="estado_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}" {{ $municipio->estado_id == $estado->id ? 'selected' : '' }}>
                            {{ $estado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</body>
</html>