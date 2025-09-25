<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Ventum;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with(['productos', 'usuarios', 'venta'])
        ->orderBy('ID_PEDIDO')
        ->get();
        return view('pedido.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pedido.create',[
        'pedido' => null,
        'productos'=> Producto::orderBy('ID_PRODUCTO')->get(['ID_PRODUCTO', 'Referencia_producto']),
        'usuarios' => Usuario::orderBy('ID_USUARIO')->get(['ID_USUARIO','Nombres','Apellidos']), 
        'ventas'   =>Ventum::orderBy('ID_VENTA')->get (['ID_VENTA','Nombre_producto']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {
        Pedido::create($request->validated());
        return redirect()->route('pedido.index')->with('ok','pedido creado');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        return view ('pedido.edit',[
        'pedido' => $pedido,
        'productos'=> Producto::orderBy('ID_PRODUCTO')->get(['ID_PRODUCTO', 'Referencia_producto']),
        'usuarios'   => Usuario::orderBy('ID_USUARIO')->get(['ID_USUARIO','Nombres','Apellidos']), 
        'ventas'   =>Ventum::orderBy('ID_VENTA')->get (['ID_VENTA','Nombre_producto']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        $pedido->update($request->validated());
        return redirect()->route('pedido.index')->with('ok','pedido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        try{
        $pedido->delete();
            return back()->with('ok', 'Pedido eliminado'); 
        }catch (\Throwable $e) {
            // suele fallar si hay fks (p. ej. dependientes) sin cascade
            return back()->withErrors('No se puede eliminar: tiene registros relacionados.');
    }
}
}