<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable =['id_venda','gsm','contrato','filial','data_pedido',
                            'tipo_pedido','cod_produto_datasys','descr_prod',
                            'grupo_estoque','valor_total','nome_vendedor',
                            'nome_cliente'];
}
