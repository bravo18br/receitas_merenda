<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitasTable extends Migration
{
    public function up()
    {
        Schema::create('merenda_receitas.receitas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('imagem')->nullable(); 
            $table->string('caminho_pdf'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('merenda_receitas.receitas');
    }
}