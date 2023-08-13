<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\medicos\Medicos;
use App\Models\ris\ris_plantillas;
use App\Models\ris\ris_relplantillaradiologo;
use Illuminate\Support\Facades\Auth;
use App\Models\usuariosclientes\Usuariosclientes;

class RisRelplantillasradiologos extends Component
{
    protected $listeners = ['elimarregistro', 'addradiologo'];
    public $idcliente, $idplantilla, $idradiologo;
    public $radiologos = [];
    public $plantillas = [];
    public $relplantillas = [];

    protected function rules()
    {
        return [
            'idradiologo' => ['required'],
        ];
    }
    public function mount()
    {
        $user = Auth::user();
        $cu = Usuariosclientes::where('user_id', '=', $user->id)->first();
        $this->idcliente = $cu->cliente_id;
        $this->plantillas =  ris_plantillas::where('cliente_id', '=', $cu->cliente_id)
            ->selectRaw("id,nombre,case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->get();

        //$this->actuaizarcombo();
    }

    public function elimarregistro(string $relplantilla)
    {
        ris_relplantillaradiologo::where('id', $relplantilla)->delete();
        $this->actuaizarcombo();
    }
    public function addradiologo(string $plantillaid)
    {
        $this->idplantilla = $plantillaid;

        $this->actuaizarcombo();
        $this->dispatchBrowserEvent('show-modal');

        // $this->dispatchBrowserEvent('buscaragenda');
        //   ris_relplantillaradiologo::where('id', $relplantilla)->delete();
        //     $this->actuaizarcombo();
    }
    public function store()
    {

        $this->validate();
        ris_relplantillaradiologo::create([
            'cliente_id' => $this->idcliente,
            'plantilla_id' => $this->idplantilla,
            'medico_id' => $this->idradiologo
        ]);
        $this->actuaizarcombo();
        $this->idradiologo = "";
    }

    public function render()
    {
        return view('livewire.ris-relplantillasradiologos');
        /*
        return view(
            'livewire.ris-relplantillasradiologos',
            ['relplantillas' => ris_relplantillaradiologo::where('plantilla_id', $this->idplantilla)
                ->join('medicos', 'medicos.id', 'ris_relplantillasradiologos.medico_id')
                ->selectRaw('ris_relplantillasradiologos.id as id,medicos.nombre as nombre')
                ->get()]
        );*/
    }

    public function actuaizarcombo()
    {
        $this->radiologos = Medicos::where('cliente_id', '=',  $this->idcliente)
            ->selectRaw('medicos.id as id,medicos.nombre as nombre')
            ->whereNotIn('medicos.id', function ($query) {
                $query->select('ris_relplantillasradiologos.medico_id')->from('ris_relplantillasradiologos');
            })->get();

        $this->relplantillas = ris_relplantillaradiologo::where('plantilla_id', $this->idplantilla)
            ->join('medicos', 'medicos.id', 'ris_relplantillasradiologos.medico_id')
            ->selectRaw('ris_relplantillasradiologos.id as id,medicos.nombre as nombre')
            ->get();
    }
}
