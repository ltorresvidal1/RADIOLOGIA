<?php

namespace App\Models\ris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ris_salas extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "ris_salas";

    protected $fillable = [
        'cliente_id',
        'sede_id',
        'nombre',
        'idestado'

    ];



    protected $casts = [
        'id' => 'string',
        'cliente_id' => 'string',
        'sede_id' => 'string'
    ];
}
