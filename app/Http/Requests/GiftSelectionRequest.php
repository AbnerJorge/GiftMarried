<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftSelectionRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'gift_id' => 'required|exists:gifts,id|unique:gift_selections,gift_id',
            'payment_method' => 'required|in:Yape,Transferencia',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'gift_id.required' => 'Debe seleccionar un regalo.',
            'gift_id.exists' => 'El regalo seleccionado no existe.',
            'gift_id.unique' => 'Este regalo ya ha sido seleccionado por otra persona.',
            'payment_method.required' => 'Debe elegir un método de pago.',
            'payment_method.in' => 'Método de pago inválido.',
            'payment_proof.required' => 'Debe subir una imagen del comprobante de pago.',
            'payment_proof.image' => 'El archivo debe ser una imagen.',
            'payment_proof.mimes' => 'Formato de imagen no permitido. Use JPEG, PNG o JPG.',
            'payment_proof.max' => 'La imagen no debe superar los 2MB.'
        ];
    }
}
