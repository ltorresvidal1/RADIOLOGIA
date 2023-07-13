<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_motivoscancelaciones;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_motivoscancelaciones;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_motivoscancelacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = Auth::user();
        $idcliente = Usuariosclientes::where('user_id', '=', $user->id)
            ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
            ->select('clientes.id')
            ->first();

        $motivoscancelaciones = ris_motivoscancelaciones::where('cliente_id', '=', $idcliente->id)
            ->selectRaw("id,nombre,case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->paginate();

        return view('ris.motivoscancelaciones.index', compact('motivoscancelaciones'));
    }

    public function create()
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.motivoscancelaciones.create', compact('estados'));
    }


    public function store(Storeris_motivoscancelaciones $request)
    {

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();



        ris_motivoscancelaciones::create([
            'cliente_id' => $cu->cliente_id,
            'nombre' => $request->nombre,
            'idestado' => $request->idestado

        ]);


        notify()->success('Motivo Cancelacion Creado', 'Confirmacion');
        return redirect()->route('rismotivoscancelaciones.create');
    }


    public function edit(ris_motivoscancelaciones $motivocancelacion)
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.motivoscancelaciones.edit', compact('motivocancelacion', 'estados'));
    }
    public function update(Storeris_motivoscancelaciones $request, ris_motivoscancelaciones $motivocancelacion)
    {



        $motivocancelacion->update($request->all());

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        notify()->success('Motivo Cancelacion Actualizado', 'Confirmacion');

        return redirect()->route('rismotivoscancelaciones.edit', compact('motivocancelacion',  'estados'));
    }


    public function destroy(ris_motivoscancelaciones $motivocancelacion)
    {


        $motivocancelacion->delete();

        notify()->success('Motivo Cancelacion Eliminado', 'Confirmacion');
        return redirect()->route('rismotivoscancelaciones.index');
    }
}
