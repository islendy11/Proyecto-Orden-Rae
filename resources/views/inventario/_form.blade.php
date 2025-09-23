@php
    $val = fn($key, $default = '') => old($key, isset($inventario) ? ($inventario->{$key} ?? $default) : $default);
@endphp

<div class="space-y-6 max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-lg">

    <!-- Referencia + Categoría -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Referencia del producto <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                name="Referencia_producto"
                value="{{ $val('Referencia_producto') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
                required
            >
            @error('Referencia_producto')
                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Categoría <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                name="Categoria_producto"
                value="{{ $val('Categoria_producto') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
                required
            >
            @error('Categoria_producto')
                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <!-- Color -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Color <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            name="Color_producto"
            value="{{ $val('Color_producto') }}"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
            required
        >
        @error('Color_producto')
            <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Cantidad -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Cantidad disponible <span class="text-red-500">*</span>
        </label>
        <input
            type="number"
            name="Cantidad_producto"
            value="{{ $val('Cantidad_producto') }}"
            min="0"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
            placeholder="0"
            required
        >
        @error('Cantidad_producto')
            <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Estado -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Estado del producto <span class="text-red-500">*</span>
        </label>
        <select
            name="Estado_producto"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm bg-white"
            required
        >
            <option value="" disabled {{ !$val('Estado_producto') ? 'selected' : '' }}>
                -- Selecciona un estado --
            </option>
            <option value="DISPONIBLE" @selected($val('Estado_producto') == 'DISPONIBLE')>
                🟢 DISPONIBLE
            </option>
            <option value="AGOTADO" @selected($val('Estado_producto') == 'AGOTADO')>
                🔴 AGOTADO
            </option>
            <option value="EN PRODUCCIÓN" @selected($val('Estado_producto') == 'EN PRODUCCIÓN')>
                🟡 EN PRODUCCIÓN
            </option>
        </select>
        @error('Estado_producto')
            <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Usuario Responsable -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Asignar a usuario <span class="text-red-500">*</span>
        </label>
        <select
            name="usuarios_id"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm bg-white"
            required
        >
            <option value="" disabled {{ !$val('usuarios_id') ? 'selected' : '' }}>
                -- Selecciona un usuario --
            </option>
            @foreach ($usuarios as $usuario)
                <option
                    value="{{ $usuario->ID_USUARIO }}"
                    @selected($val('usuarios_id') == $usuario->ID_USUARIO)
                >
                    [{{ $usuario->ID_USUARIO }}] {{ $usuario->Nombres }} {{ $usuario->Apellidos }}
                </option>
            @endforeach
        </select>
        @error('usuarios_id')
            <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $message }}
            </p>
        @enderror
    </div>
</div>