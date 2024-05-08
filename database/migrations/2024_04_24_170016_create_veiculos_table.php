<?php

use Illuminate\Database\Migrations\Migration; //Está importando a classe migration
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('veiculos', function (Blueprint $table) {//Está criando uma tabela no banco de dados chamada veiculos
            $table->id();//Adiciona o nome da coluna no banco de dados e defini o seu tipo
            $table->string('usuario_id')->nullable();//Adicionando nome do usuario_id no banco de dados e nullable() significa que esse campo pode ser nulo,não é obrigatório fornecer um valor para ele.
            $table->string('placa');//Adiciona o nome da coluna no banco de dados como placa
            $table->string('modelo');
            $table->string('cor');
            $table->string('marca'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void //Utilizando uma migração com a função down
    {
        Schema::dropIfExists('veiculos'); //e essa função esta excluindo a tabela veiculos do banco de dados(que exclui a tabela se ela existir,se a tabela não existir, nenhuma ação será tomada.)
    }
};
