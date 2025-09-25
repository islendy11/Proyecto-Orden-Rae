<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest
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
        return [
            'Fecha_de_compra'   => 'required|date',
            'Fecha_de_entrega'  => 'required|date|after_or_equal:Fecha_de_compra',
            'Total_de_pago'     => 'required|integer|min:0',
            'Estado_pedido'     => 'required|string|in:CANCELADO,EN PROCESO,ENTREGADO,PENDIENTE',
            'usuarios_id'       => 'required|exists:usuarios,ID_USUARIO',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'Fecha_de_compra.required'  => 'La fecha de compra es obligatoria.',
            'Fecha_de_compra.date'      => 'La fecha de compra debe tener un formato válido (AAAA-MM-DD).',

            'Fecha_de_entrega.required' => 'La fecha de entrega es obligatoria.',
            'Fecha_de_entrega.date'     => 'La fecha de entrega debe tener un formato válido (AAAA-MM-DD).',
            'Fecha_de_entrega.after_or_equal' => 'La fecha de entrega no puede ser anterior a la fecha de compra.',

            'Total_de_pago.required'    => 'El total de pago es obligatorio.',
            'Total_de_pago.integer'     => 'El total debe ser un número entero.',
            'Total_de_pago.min'         => 'El total no puede ser negativo.',

            'Estado_pedido.required'    => 'El estado del pedido es obligatorio.',
            'Estado_pedido.in'          => 'El estado solo puede ser:CANCELADO,EN PROCESO,ENTREGADO o PENDIENTE.',

            'usuarios_id.required'      => 'Debe seleccionar un usuario responsable.',
            'usuarios_id.exists'        => 'El usuario seleccionado no es válido.',
        ];
    }
}