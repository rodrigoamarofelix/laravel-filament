<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'cpf',
        'sexo',
        'is_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
