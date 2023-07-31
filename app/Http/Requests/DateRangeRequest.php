<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class DateRangeRequest extends FormRequest
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
        $this->request->get('data_inicial') = Carbon::parse($this->request->get('data_inicial'))->format('d/m/Y');

        $rules = [
            'data_inicial'  => 'date_format:d-m-Y|after:today'
        ];

        if ($this->request->has('data_inicial') && $this->request->get('data_inicial') != $this->request->get('data_final')) {
            $rules['data_final'] = 'date_format:d-m-Y|after:data_inicial';
        } else {
            $rules['data_final'] = 'date_format:d-m-Y|after:today';
        }

        return $rules;
    }
}
