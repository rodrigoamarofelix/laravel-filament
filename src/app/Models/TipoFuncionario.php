<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFuncionario extends Model
{
    use HasFactory;
    protected $fillable = [
        'ds_tipo',
        'is_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}
