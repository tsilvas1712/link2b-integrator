<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiveDataRequest extends FormRequest
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
      "*" => "array",
      "*.id_venda" => "required|integer",
      "*.gsm" => "required|string",
      "*.gsm_portable" => "string|nullable",
      "*.cupom_fiscal" => "string|nullable",
      "*.filial" => "required|string",
      "*.data_pedido" => "required",
      "*.nf_compra" => "required|string",
      "*.tipo_pedido" => "required|string",
      "*.modalidade" => "required|string",
      "*.nota_fiscal" => "required|string",
      "*.data_nf" => "required",
      "*.descricao" => "required|string",
      "*.fabricante" => "required|string",
      "*.serial" => "required|string",
      "*.qantidade" => "required|integer",
      "*.valor_tabela" => "required|numeric",
      "*.valor_plano" => "required|numeric",
      "*.valor_caixa" => "required|numeric",
      "*.desconto" => "required|numeric",
      "*.total_item" => "required|numeric",
      "*.nome_vendedor" => "required|string",
      "*.nome_cliente" => "required|string",
    ];
  }
}
