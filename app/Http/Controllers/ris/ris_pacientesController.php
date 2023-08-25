<?php

namespace App\Http\Controllers\ris;

use notify;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ris\ris_pacientes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Http\Requests\ris\Storeris_pacientes;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_pacientesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $pacientes = ris_pacientes::selectRaw("ris_pacientes.id,documento,
            concat(primernombre,' ',segundonombre,' ',primerapellido,' ',segundoapellido)as nombre,
            fechanacimiento,
            concat(date_part('year',age( CAST (fechanacimiento AS date ))),' años ',
             date_part('month',age( CAST (fechanacimiento AS date ))),' meses ',
            date_part('day',age( CAST (fechanacimiento AS date ))),' dias ') as edad
            
            ,ris_pacientes.celular as celular")
            ->paginate();

        return view('ris.pacientes.index', compact('pacientes'));
    }

    public function create()
    {

        $fechaactual = Carbon::now()->setTimezone('America/Bogota');
        $tipoid = Desplegables::where('ventana', 'tipodocumento')->where('estado', '1')->get();
        $sexos = Desplegables::where('ventana', 'genero')->where('estado', '1')->get();

        return view('ris.pacientes.create', compact('tipoid', 'sexos', 'fechaactual'));
    }


    public function store(Storeris_pacientes $request)
    {

        ris_pacientes::create([
            'idtipoid' => $request->idtipoid,
            'documento' => $request->documento,
            'primernombre' => $request->primernombre,
            'segundonombre' => $request->segundonombre,
            'primerapellido' => $request->primerapellido,
            'segundoapellido' => $request->segundoapellido,
            'fechanacimiento' => $request->fechanacimiento,
            'idsexo' => $request->idsexo,
            'direccion' => $request->direccion,
            'barrio' => $request->barrio,
            'celular' => $request->celular,
            'telefonow' => $request->telefono,
            'correo' => $request->correo,
            'idestado' => '1'
        ]);


        notify()->success('Paciente Creado', 'Confirmacion');
        return redirect()->route('rispacientes.create');
    }

    public function edit(ris_pacientes $paciente)
    {
        $fechaactual = Carbon::now()->setTimezone('America/Bogota');
        $tipoid = Desplegables::where('ventana', 'tipodocumento')->where('estado', '1')->get();
        $sexos = Desplegables::where('ventana', 'genero')->where('estado', '1')->get();

        return view('ris.pacientes.edit', compact('paciente', 'tipoid', 'sexos', 'fechaactual'));
    }
    public function update(Storeris_pacientes $request, ris_pacientes $paciente)
    {



        $paciente->update($request->all());

        notify()->success('Paciente Actualizado', 'Confirmacion');

        return redirect()->route('rispacientes.edit', compact('paciente'));
    }

    public function destroy(ris_pacientes $paciente)
    {


        $paciente->delete();

        notify()->success('Paciente Eliminado', 'Confirmacion');
        return redirect()->route('rispacientes.index');
    }
}
