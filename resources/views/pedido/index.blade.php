<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <a href="{{ route('pedido.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring focus:ring-blue-300 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nuevo Pedido
                </a>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="text-green-500 hover:text-green-700 font-bold" onclick="this.parentElement.remove()">
                            ×
                        </button>
                    </div>
                @endif
            </div>

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
                        @foreach ($pedidos as $pedido)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="p-3">{{ $pedido->ID_PEDIDO }}</td>
                                
                                <!-- Productos desde la relación pivote -->
                                <td>
                                    @if($pedido->productos->isNotEmpty())
                                        @foreach($pedido->productos as $producto)
                                            {{ $producto->Referencia_producto }}
                                            @if (!$loop->last), @endif
                                        @endforeach
                                    @else
                                        <span class="text-gray-400">Sin productos</span>
                                    @endif
                                </td>
                                <!-- Cantidad desde la pivote -->
                                <td>
                                    @if($pedido->productos->isNotEmpty())
                                        @foreach($pedido->productos as $producto)
                                            {{ $producto->pivot->Cantidad_solicitada }}
                                            @if (!$loop->last)<br>@endif
                                        @endforeach
                                    @else
                                        <span class="text-gray-400">0</span>
                                    @endif
                                </td>
                                <td>{{ $pedido->Metodo_pago }}</td>
                                <td>${{ number_format($pedido->Total_de_pago, 2) }}</td>
                                <td>{{ $pedido->Estado_pedido }}</td>
                                <td>{{ $pedido->Fecha_de_compra?->format('d/m/Y') }}</td>
                                <td>{{ $pedido->Fecha_de_entrega?->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 gap-2 flex justify-center">
                                    <a href="{{ route('pedido.edit', $pedido->ID_PEDIDO) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                                        Editar
                                    </a>
                                    <form action="{{ route('pedido.destroy', $pedido->ID_PEDIDO) }}" method="POST"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md"
                                        style="display:inline" onsubmit="return confirm('¿Deseas eliminar este pedido?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/datatables.css') }}">

<!-- jQuery y DataTables JS -->
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
    $(function() {
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