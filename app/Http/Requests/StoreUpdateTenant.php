<?php

  namespace App\Http\Requests;

  use Illuminate\Foundation\Http\FormRequest;

  class StoreUpdateTenant extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
      return [
        'tenant_name' => "required|min:3|max:255|unique:tenants,tenant_name",
        'cpf_cnpj' => "required|min:11|max:14",
        'phone' => "nullable|min:11|max:13",
        'contact' => "nullable|min:5|max:255",
      ];
    }
  }
