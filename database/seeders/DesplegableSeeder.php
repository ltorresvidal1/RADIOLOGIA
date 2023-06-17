<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\desplegable;
class DesplegableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desplegable1 = new desplegable();
        $desplegable1->nombre="Activo";
        $desplegable1->ventana="estados";
        $desplegable1->estado="1";
        $desplegable1->created_at="2022-08-16 09:12";
        $desplegable1->save();

        $desplegable2 = new desplegable();
        $desplegable2->nombre="Inactivo";
        $desplegable2->ventana="estados";
        $desplegable2->estado="1";
        $desplegable2->created_at="2022-08-16 09:12";
        $desplegable2->save();
    }
}
