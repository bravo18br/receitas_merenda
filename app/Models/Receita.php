<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    protected $table = 'merenda_receitas.receitas';

    public static function buscarTodasReceitas()
    {
        return self::inRandomOrder()->get();
    }
}