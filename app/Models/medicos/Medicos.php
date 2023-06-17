<?php

namespace App\Models\medicos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicos extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'documento',
        'nombre',
        'registromedico',
        'firma',
        'cliente_id',
        'idestado'
    ];

    protected $casts = [
        'id' => 'string',
        'cliente_id' => 'string'
    ];
}
