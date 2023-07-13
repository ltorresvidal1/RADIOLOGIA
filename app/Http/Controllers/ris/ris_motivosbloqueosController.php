<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_motivosbloqueos;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_motivosbloqueos;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_motivosbloqueosController extends Controller
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

        $motivosbloqueos = ris_motivosbloqueos::where('cliente_id', '=', $idcliente->id)
            ->selectRaw("id,nombre,case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->paginate();

        return view('ris.motivosbloqueos.index', compact('motivosbloqueos'));
    }

    public function create()
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.motivosbloqueos.create', compact('estados'));
    }


    public function store(Storeris_motivosbloqueos $request)
    {

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();



        ris_motivosbloqueos::create([
            'cliente_id' => $cu->cliente_id,
            'nombre' => $request->nombre,
            'idestado' => $request->idestado

        ]);


        notify()->success('Motivo Bloqueo Creado', 'Confirmacion');
        return redirect()->route('rismotivosbloqueos.create');
    }


    public function edit(ris_motivosbloqueos $motivobloqueo)
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.motivosbloqueos.edit', compact('motivobloqueo', 'estados'));
    }
    public function update(Storeris_motivosbloqueos $request, ris_motivosbloqueos $motivobloqueo)
    {



        $motivobloqueo->update($request->all());

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        notify()->success('Motivo Bloqueo Actualizado', 'Confirmacion');

        return redirect()->route('rismotivosbloqueos.edit', compact('motivobloqueo',  'estados'));
    }


    public function destroy(ris_motivosbloqueos $motivobloqueo)
    {


        $motivobloqueo->delete();

        notify()->success('Motivo Bloqueo Eliminado', 'Confirmacion');
        return redirect()->route('rismotivosbloqueos.index');
    }
}
