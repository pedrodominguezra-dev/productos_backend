<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParamsTableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:100',
            'offset' => 'nullable|integer|min:0',
            'limit' => 'nullable|integer|min:1|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => 'La palabra a buscar en la tabla no es válido',
            'search.max' => 'El máximo de palabras a buscar es 100 caracteres',
            'offset.integer' => 'El offset es inválido',
            'offset.min' => 'El offset debe ser al menos 0',
            'limit.integer' => 'El límite de datos a mostrar no es válido',
            'limit.min' => 'El límite de datos mínimo a mostrar es 1',
            'limi.max' => 'El límite de datos mínimo a mostrar es 100'
        ];
    }

    // Manda una excepción que no pasaron las validaciones
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Existen errores en la información',
            'errors' => $validator->errors()
        ], 422));
    }
}
