<?php

namespace App\Imports;

namespace App\Models\inventarioinicial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class InventarioinicialImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
private $finca_id;
private $cliente_id;
private $fechainicial;

public function __construct($finca_id,$cliente_id,$fechainicial)
{
    $this->finca_id=$finca_id;
    $this->cliente_id=$cliente_id;
    $this->fechainicial=$fechainicial;
}
    public function model(array $row)
    {
        return new inventarioinicial([
         
            
            'finca_id'     =>  $this->finca_id,
            'cliente_id'     =>  $this->cliente_id,
            'fechainicial'     => $this->fechainicial,
            'numeroanimal'     => $row['numeroanimal'],
            'estadoproduccion'     => $row['estadoproduccion'],
            'fechanacimiento'     => $row['fechanacimiento'],
            'madre'     => $row['madre'],
            'fechaultp'     => $row['fechaultp'],
            'diaspreñes'     => $row['diasprenes'],
            'fechapreñes'     => $row['fechaprenes'],
            'tipopreñes'     => $row['tipoprenes'],
            'kilos'     => $row['kilos'],
            'valor'     => $row['valor']
        ]);
    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }
}
