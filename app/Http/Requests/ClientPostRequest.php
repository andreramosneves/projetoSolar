<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientPostRequest extends FormRequest
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
     *     protected $fillable = ['name','email','phone','document','type_document'];
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',
            'phone' => 'nullable|integer|digits:11',
            'document' => 'required|numeric|cpf_cnpj',
            'type_document'=> 'required|in:cpf,cnpj'
            //
        ];
    }
}
