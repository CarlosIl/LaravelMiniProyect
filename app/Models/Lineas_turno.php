<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineas_turno extends Model
{
    use HasFactory;

    protected $fillable = ['dia','id_turno', 'id_horario'];
}
