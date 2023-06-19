<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable =['campaign_id','id_venda','gsm','filial','data_pedido',
                            'tipo_pedido','cod_produto_datasys','descr_prod',
                            'modalidade_venda','valor_total','nome_vendedor',
                            'nome_cliente','status'];


    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }
}
