<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ris\ris_salas;
use App\Models\ris\ris_sedes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_agendas;
use Illuminate\Console\View\Components\Alert;
use App\Models\usuariosclientes\Usuariosclientes;

class CrearagendasComponent extends Component
{
    public $idcliente, $sede, $sala, $fechaactual, $fechainicial, $horainicial, $fechafinal, $horafinal, $estado = "1";
    public $sedes = [], $salas = [], $estados = [], $dias = [];



    protected function rules()
    {
        return [
            'sede' => ['required'],
            'sala' => ['required'],
            'fechainicial' => ['required'],
            'horainicial' => ['required'],
            'fechafinal' => ['required'],
            'horafinal' => ['required'],
            'dias' => ['required'],
        ];
    }


    public function mount()
    {
        $user = Auth::user();
        $cu = Usuariosclientes::where('user_id', '=', $user->id)->first();
        $this->idcliente = $cu->cliente_id;
        $this->sedes = ris_sedes::where('cliente_id', '=', $cu->cliente_id)->get();
        $this->salas = collect();
        $this->estados =  Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $this->fechaactual = Carbon::now()->setTimezone('America/Bogota');
        $this->horainicial = "07:00";
        $this->horafinal = "18:00";
    }

    public function updatedSede($value)
    {
        $this->salas = ris_salas::where('idestado', '1')->where('sede_id', $value)->get();
        $this->sala = $this->salas->first()->id ?? null;
    }


    public function store()
    {


        $this->validate();

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();


        ris_agendas::create([

            'cliente_id' => $cu->cliente_id,
            'sede_id' => $this->sede,
            'sala_id' => $this->sala,
            'fechainicial' => $this->fechainicial,
            'horainicial' => $this->horainicial,
            'fechafinal' => $this->fechafinal,
            'horafinal' => $this->horafinal,
            'dias' => json_encode($this->dias),
            'idestado' =>  $this->estado,

        ]);

        notify()->success('Agenda Creada', 'Confirmacion');
        return redirect()->route('risagendas.create');
    }


    public function render()
    {
        return view('livewire.crearagendas-component');
    }
}
