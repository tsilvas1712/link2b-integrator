<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('sales', function (Blueprint $table) {
      $table->id();
      $table->foreignId('campaign_id')->constrained('campaigns');
      $table->bigInteger('id_venda');
      $table->string('gsm')->nullable();
      $table->string('filial');
      $table->timestamp('data_pedido');
      $table->string('nf_compra')->nullable();
      $table->string('tipo_pedido')->nullable();
      $table->string('cupom_fiscal')->nullable();
      $table->string('modalidade')->nullable();
      $table->string('nota_fiscal')->nullable();
      $table->timestamp('data_nf')->nullable();
      $table->text('descricao')->nullable();
      $table->string('fabricante')->nullable();
      $table->string('serial')->nullable();
      $table->string('qantidade')->nullable();
      $table->double('valor_tabela', 10, 2)->nullable();
      $table->double('valor_plano', 10, 2)->nullable();
      $table->double('valor_caixa', 10, 2)->nullable();
      $table->string('desconto')->nullable();
      $table->double('total_item', 10, 2)->nullable();
      $table->string('nome_vendedor')->nullable();
      $table->string('nome_cliente')->nullable();
      $table->enum('status', ['PENDENTE', 'PORTABILIDADE', 'AGENDADO', 'ENVIADO', 'ERROR', 'REPETIDO']);
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
