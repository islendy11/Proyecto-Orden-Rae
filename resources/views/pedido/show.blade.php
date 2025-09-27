<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">

            <!-- Botón y alerta -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <a href="{{ route('pedido.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring focus:ring-blue-300 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nuevo Pedido
                </a>

                @if(session('success'))
                    <div
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="text-green-500 hover:text-green-700 font-bold"
                                onclick="this.parentElement.remove()">
                            ×
                        </button>
                    </div>
                @endif
            </div>

            <!-- Tabla de pedidos -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table id="producto" class="min-w-full text-base text-center text-gray-500">
                    <thead class="text-base text-gray-700 bg-gray-50">
                    <tr class="bg-white border-b border-gray-200">
                        <th class="p-3">ID</th>
                        <th>Productos</th>
                        <th>Cantidad</th>
                        <th>Método de pago</th>
                        <th>Total de pago</th>
                        <th>Estado del pedido</th>
                        <th>Fecha de compra</th>
                        <th>Fecha de entrega</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pedidos as $item)
                        @forelse($item->productos as $producto)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="p-3">
                                    <a href="{{ route('pedido.show', $item->ID_PEDIDO) }}"
                                       class="text-blue-600 hover:underline">
                                        {{ $item->ID_PEDIDO }}
                                    </a>
                                </td>
                                <td>{{ $producto->Referencia_producto }}</td>
                                <td>
                                    {{ $producto->Cantidad_solicitada?->Cantidad ?? 0 }}
                                </td>
                                <td>{{ $item->Referencia_producto }}</td>
                                <td>{{ $item->Cantidad_solicitada }}</td>
                                <td>{{ $item->Metodo_pago }}</td>
                                <td>{{ $item->Total_de_pago }}</td>
                                <td>{{ $item->Estado_pedido }}</td>
                                <td>{{ $item->Fecha_de_compra }}</td>
                                <td>{{ $item->Fecha_de_entrega }}</td>
                                <td class="px-4 py-3 flex justify-center gap-2">
                                    <a href="{{ route('pedido.edit', $item->ID_PEDIDO) }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded-md text-sm">
                                        Editar
                                    </a>
                                    <form action="{{ route('pedido.destroy', $item->ID_PEDIDO) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-md text-sm"
                                                onclick="return confirm('¿Deseas eliminar este pedido?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-3 text-gray-500">
                                    No hay productos en este pedido
                                </td>
                            </tr>
                        @endforelse
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Estilos de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Inicialización de DataTable -->
    <script>
        $(document).ready(function () {
            $('#producto').DataTable({
                pageLength: 20,
                dom: 'Bfrtip',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                },
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
</x-app-layout>
