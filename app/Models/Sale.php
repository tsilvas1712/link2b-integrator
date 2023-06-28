<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;

  class Sale extends Model
  {
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
      'campaign_id',
      'id_venda',
      'gsm',
      'filial',
      'data_pedido',
      'nf_compra',
      'tipo_pedido',
      'cumpom_fiscal',
      'modalidade',
      'nota_fiscal',
      'data_nf',
      'descricao',
      'fabricante',
      'serial',
      'qantidade',
      'valor_tabela',
      'valor_plano',
      'valor_caixa',
      'desconto',
      'total_item',
      'nome_vendedor',
      'nome_cliente',
      'status'
    ];


    public function campaign()
    {
      return $this->hasOne(Campaign::class);
    }
  }
