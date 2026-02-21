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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vendedor');
            $table->foreign('id_vendedor')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pendente', 'concluida', 'cancelada'])->default('pendente');
            $table->timestamps();
        });

        Schema::create('itens_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_compra');
            $table->foreign('id_compra')->references('id')->on('compras')->onDelete('cascade');
            $table->unsignedBigInteger('id_produto');
            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('cascade');
            $table->integer('quantidade');
            $table->decimal('preco', 10, 2);
            $table->timestamps();
        });

        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_compra');
            $table->foreign('id_compra')->references('id')->on('compras')->onDelete('cascade');
            $table->string('reference_id');
            $table->enum('status', ['aguardando_pagamento', 'confirmado', 'cancelado'])->default('aguardando_pagamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
        Schema::dropIfExists('itens_compras');
        Schema::dropIfExists('compras');
    }
};
