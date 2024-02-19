<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToReceitasTable extends Migration
{
    public function up()
    {
        // Adicionar dados à tabela 'receitas'
        DB::table('merenda_receitas.receitas')->insert([
            ['titulo' => 'Titulo Receita 1', 'imagem' => 'resources\dados_teste\imagem1.jpg', 'caminho_pdf' => 'resources\dados_teste\PDF_receita1.pdf', 'created_at' => now(), 'updated_at' => now()],
            ['titulo' => 'Titulo Receita 2', 'imagem' => 'resources\dados_teste\imagem2.jpg', 'caminho_pdf' => 'resources\dados_teste\PDF_receita2.pdf', 'created_at' => now(), 'updated_at' => now()],
            ['titulo' => 'Titulo Receita 3', 'imagem' => 'resources\dados_teste\imagem3.jpg', 'caminho_pdf' => 'resources\dados_teste\PDF_receita3.pdf', 'created_at' => now(), 'updated_at' => now()],
            ['titulo' => 'Titulo Receita 4', 'imagem' => 'resources\dados_teste\imagem4.jpg', 'caminho_pdf' => 'resources\dados_teste\PDF_receita4.pdf', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        // Remover os dados adicionados na migração acima, se necessário
        DB::table('merenda_receitas.receitas')->whereIn('titulo', ['Titulo Receita 1', 'Titulo Receita 2', 'Titulo Receita 3', 'Titulo Receita 4'])->delete();
    }
}
