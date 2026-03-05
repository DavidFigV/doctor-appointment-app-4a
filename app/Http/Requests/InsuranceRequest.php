<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InsuranceRequest extends FormRequest
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
     */
    public function rules(): array
    {
        /*
         * Se usa Rule::unique con ->ignore() para que en ediciones futuras
         * se pueda reutilizar esta misma Request sin duplicar lógica.
         * En store(), $this->route('insurance') será null, por lo que el ignore no tiene efecto.
         * Alternativa descartada: unique:insurances,nombre_empresa,{id} inline — menos expresivo y
         * más difícil de mantener en contextos donde el ID cambia (soft-delete restores, etc.).
         */
        return [
            'nombre_empresa' => [
                'required',
                'string',
                'max:150',
                Rule::unique('insurances', 'nombre_empresa')
                    ->ignore($this->route('insurance'))
                    ->whereNull('deleted_at'),
            ],
            'telefono_contacto' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9()\-\s\+]+$/',
            ],
            'notas_adicionales' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }

    /**
     * Custom error messages in Spanish.
     */
    public function messages(): array
    {
        return [
            'nombre_empresa.required'    => 'El nombre de la empresa es obligatorio.',
            'nombre_empresa.max'         => 'El nombre no puede exceder los 150 caracteres.',
            'nombre_empresa.unique'      => 'Ya existe una aseguradora con ese nombre.',
            'telefono_contacto.required' => 'El teléfono de contacto es obligatorio.',
            'telefono_contacto.max'      => 'El teléfono no puede exceder los 20 caracteres.',
            'telefono_contacto.regex'    => 'El teléfono solo puede contener números, paréntesis, guiones, espacios y el signo +.',
            'notas_adicionales.max'      => 'Las notas no pueden exceder los 1,000 caracteres.',
        ];
    }

    /**
     * Human-readable field names for error messages.
     */
    public function attributes(): array
    {
        return [
            'nombre_empresa'    => 'nombre de la empresa',
            'telefono_contacto' => 'teléfono de contacto',
            'notas_adicionales' => 'notas adicionales',
        ];
    }
}
