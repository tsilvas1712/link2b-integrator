<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_venda');
            $table->string('gsm')->nullable();
            $table->string('contrato')->nullable();
            $table->string('filial')->nullable();
            $table->timestamp('data_pedido');
            $table->string('tipo_pedido')->nullable();
            $table->string('cod_produto_datasys')->nullable();
            $table->string('descr_prod')->nullable();
            $table->string('grupo_estoque')->nullable();
            $table->double('valor_total', 10, 2);
            $table->string('nome_vendedor')->nullable();
            $table->string('nome_cliente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
