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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf');
            $table->string('telefone');
            $table->date('data_nascimento');
            $table->string('foto_perfil')->nullable();
            $table->decimal('saldo', 8, 2)->default(0);
            $table->enum('tipo', ['padrao', 'admin'])->default('padrao');
            $table->integer('id_criador')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('users', ['cpf', 'telefone', 'data_nascimento', 'foto_perfil', 'saldo', 'tipo', 'id_criador']);
    }
};
