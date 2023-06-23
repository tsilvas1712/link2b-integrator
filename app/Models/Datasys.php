<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datasys extends Model
{
  use HasFactory;

  protected $fillable = [
    'tenant_id', 'id_venda', 'gsm', 'gsm_portable', 'filial',
    'data_pedido', 'nf_compra', 'tipo_pedido', 'cumpom_fiscal', 'modalidade', 'nota_fiscal', 'data_nf',
    'descricao', 'fabricante', 'serial', 'qantidade', 'valor_tabela', 'valor_plano', 'valor_caixa',
    'desconto', 'total_item', 'nome_vendedor', 'nome_cliente'
  ];
}
