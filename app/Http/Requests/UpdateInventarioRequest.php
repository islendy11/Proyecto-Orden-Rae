<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule; 
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('inventario') ? $this->route('inventario')->ID_INVENTARIO : null;
        

        return [
            'Referencia_producto' => [
                'required',
                'string',
                'max:50',
                Rule::unique('producto','Referencia_producto')->ignore($id, 'ID_INVENTARIO')
            ],
            'Categoria_producto'  => 'required|string|max:50',
            'Color_producto'      => 'required|string|max:50',
            'Cantidad_producto'   => 'required|integer|min:0',
            'Estado_producto'     => 'required|string|in:DISPONIBLE,AGOTADO',
            'usuarios_id'         => 'required|integer|exists:usuarios,ID_USUARIO',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            // Referencia_producto
            'Referencia_producto.required' => 'La referencia del producto es obligatoria.',
            'Referencia_producto.string'   => 'La referencia debe ser un texto válido.',
            'Referencia_producto.max'      => 'La referencia no puede exceder los 50 caracteres.',
            
            // Categoria_producto
            'Categoria_producto.required'  => 'La categoría del producto es obligatoria.',
            'Categoria_producto.string'    => 'La categoría debe ser un texto válido.',
            'Categoria_producto.max'       => 'La categoría no puede exceder los 50 caracteres.',

            // Color_producto
            'Color_producto.required'      => 'El color del producto es obligatorio.',
            'Color_producto.string'        => 'El color debe ser un texto válido.',
            'Color_producto.max'           => 'El color no puede exceder los 50 caracteres.',

            // Cantidad_producto
            'Cantidad_producto.required'   => 'La cantidad es obligatoria.',
            'Cantidad_producto.integer'    => 'La cantidad debe ser un número entero.',
            'Cantidad_producto.min'        => 'La cantidad no puede ser negativa.',

            // Estado_producto
            'Estado_producto.required'     => 'El estado del producto es obligatorio.',
            'Estado_producto.string'       => 'El estado debe ser un texto válido.',
            'Estado_producto.in'           => 'El estado solo puede ser "DISPONIBLE" o "AGOTADO".',

            // Created_at
            'Created_at.required'          => 'La fecha de creación es obligatoria.',
            'Created_at.date'              => 'La fecha de creación no tiene un formato válido.',

            // update_at
            'Updated_at.date'               => 'La fecha de actualización no tiene un formato válido.',

            // usuarios_id
            'usuarios_id.required'         => 'Debes asignar un usuario al inventario.',
            'usuarios_id.integer'          => 'El ID de usuario debe ser un número válido.',
            'usuarios_id.exists'           => 'El usuario seleccionado no existe en el sistema.',

        ];
    }
}