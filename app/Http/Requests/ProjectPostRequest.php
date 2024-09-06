<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectPostRequest extends FormRequest
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
            'client_id' => 'required|integer',
            'type_installation_id' => 'required|integer',
            'uf_id' => 'required|integer',
            'equipament'    => 'required|array|min:1',
            'equipament.*.id'  => 'required|integer',           
            'equipament.*.quantity'  => 'required|integer',           

            //
        ];
    }
}
