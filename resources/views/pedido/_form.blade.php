@php
    $val = fn($key, $default = '') => old($key, isset($pedido) ? ($pedido->{$key} ?? $default) : $default);
@endphp

<div class="space-y-6 max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-lg">

    <!-- Fecha de  compra- fecha de entrega -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Fecha de compra <span class="text-red-500">*</span>
            </label>
            <input
                type="date"
                name="Fecha_de_compra"
                value="{{ $val('Fecha_de_compra') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
                required>
            @error('Fecha_de_compra')
                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Fecha de entrega <span class="text-red-500">*</span>
            </label>
            <input
                type="date"
                name="Fecha_de_entrega"
                value="{{ $val('Fecha_de_entrega') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
                required
            >
            @error('Fecha_de_entrega')
                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <!-- Total de pago  -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Total_de_pago <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            name="Total_de_pago"
            value="{{ $val('Total_de_pago') }}"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"
            required
        >
        @error('Total_de_pago')
            <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $message }}
            </p>
        @enderror
    </div>
    <!-- Estado -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Estado del pedido <span class="text-red-500">*</span>
        </label>
        <select
            name="Estado_pedido"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm bg-white"
            required
        >
            <option value="" disabled {{ !$val('Estado_pedido') ? '' : '' }}>
                -- Selecciona un estado --
            </option>
            <option value="CANCELADO" @selected($val('Estado_pedido') == 'CANCELADO')>
                🟢 CANCELADO
            </option>
            <option value="EN PROCESO" @selected($val('Estado_pedido') == 'EN PROCESO')>
                🟣 EN PROCESO
            </option>
            <option value="ENTREGADO" @selected($val('Estado_pedido') == 'ENTREGADO')>
                🟡 ENTREGADO
            </option>
            <option value="PENDIENTE" @selected($val('Estado_pedido') == 'PENDIENTE')>
                🔴  PENDIENTE
            </option>
        </select>
        @error('Estado_pedido')
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