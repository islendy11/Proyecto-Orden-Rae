<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventario = Inventario::with(['producto','usuario'])
        ->orderBy('ID_INVENTARIO')
        ->get();
        return view('inventario.index',compact('inventario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventario.create',[
            'inventario' => null,
            'producto'  => Producto::orderBy('Referencia_producto')->get(['ID_PRODUCTO','Referencia_producto']),
            'usuarios'   => Usuario::orderBy('Nombres')->get(['ID_USUARIO','Nombres','Apellidos']), 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventarioRequest $request)
    {
        Inventario::create($request->validated());
        return redirect()->route('inventario.index')->with('ok','Producto creado');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        return view ('inventario.edit',[
            'inventario' =>$inventario,
            'producto'  => Producto::orderBy('Referencia_producto')->get(['ID_PRODUCTO','Referencia_producto']),
            'usuarios'   => Usuario::orderBy('Nombres')->get(['ID_USUARIO','Nombres','Apellidos']), 
        ]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventarioRequest $request, Inventario $inventario)
    {
        $inventario->update($request->validated());
        return redirect()->route('inventario.index')->with('ok','Producto actualizado');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        try{
            $inventario->delete();
            return back()->with('ok', 'Producto eliminado'); 
        }catch (\Throwable $e) {
            // suele fallar si hay fks (p. ej. dependientes) sin cascade
            return back()->withErrors('No se puede eliminar: tiene registros relacionados.');

        }   
    }
}
