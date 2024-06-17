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
        Schema::create('pessoas', function (Blueprint $table) {//Cria a tabela pessoas no banco de dados com os seguintes campos:
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('telefone')->nullable(); // Adicionando o campo telefone
            $table->string('cpf')->unique(); // Adicionando o campo CPF e marcando como único
            $table->date('data_nascimento')->nullable(); // Adicionando o campo data de nascimento
            $table->string('password');
            $table->timestamp('deleted_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas');
    }
};
