<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventario') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
    <div class="bg-white">
        <div class="pb-2 pt-2 pl-2 bg-white items-center gap-2">
        <table id="inventario" class="w-full text-sm border-solid text-center rtl:text-right text-black dark:text-black">
            <thead class="text-base text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3">
                        Referencia
                    </th>
                    <th class="px-6 py-3">
                    Categoria
                    </th>
                    <th class="px-6 py-3">
                        Color
                    </th>
                    <th class="px-6 py-3">
                        Cantidad
                    </th>
                    <th class="px-6 py-3">
                        Estado
                    </th>
                    <th class="px-6 py-3">
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventarios as $items)
                <tr class="bg-white border-b dark:border-gray-700 border-gray-200 hover:bg-gray-100 dark:hover:bg-gray-300">
                    <td class="px-6 py-4 ">
                        {{$items->Referencia_producto}}
                    </td>
                    <td class="px-6 py-4">
                        {{$items->Categoria_producto}}
                    </td>
                    <td class="px-6 py-4">
                        {{$items->Color_producto}}
                    </td>
                    <td class="px-6 py-4">
                        {{$items->Cantidad_producto}}
                    </td>
                    <td class="px-6 py-4">
                        {{$items->Estado_producto}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class=" bg-blue-600 hover:text-blue-500 text-white py-2 px-4 rounded-md">Editar</a>
                        <a href="#" class=" bg-red-600 hover:text-red-500 text-white font-bold py-2 px-4 rounded-md">Eliminar</a>
                    </td>
                </tr>
                @endforeach            
            </tbody>







































































































































































            
        </table>
    </div>
    </div>
    </div>
</div>
{{-- jQuery + DataTables (CDN) --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<link rel="stylesheet"
href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
$(function() {
$('#inventario').DataTable({
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


