<form action="{{ route('inventario.update', $inventario) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    @include('inventario._form', [
        'inventario' => $inventario,
        'producto'   => $producto,
        'usuarios'    => $usuarios,
    ])

    <div class="pt-4 flex gap-3">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Actualizar
        </button>

        <a href="{{ route('inventario.index') }}"
            class="px-4 py-2 border rounded">
            Cancelar
        </a>
    </div>
</form>