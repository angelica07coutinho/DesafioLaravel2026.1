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
        Schema::table('produtos', function (Blueprint $table) {
            $table->renameColumn('id_usuario', 'id_vendedor');
            $table->renameColumn('foto', 'foto_produto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->renameColumn('id_vendedor', 'id_usuario');
            $table->renameColumn('foto_produto', 'foto');
        });
    }
};
