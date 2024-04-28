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
    Schema::table('campaigns', function (Blueprint $table) {
      $table->enum('type', ['DataSys', 'API', 'Upload'])->default('API');
      //
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('campaigns', function (Blueprint $table) {
      //
    });
  }
};
