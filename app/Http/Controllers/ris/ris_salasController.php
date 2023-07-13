<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_salas;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_salas;
use App\Models\ris\ris_sedes;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_salasController extends Controller
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

        $salas = ris_salas::where('ris_salas.cliente_id', '=', $idcliente->id)
            ->join('ris_sedes', 'ris_sedes.id', 'ris_salas.sede_id')
            ->selectRaw("ris_salas.id,ris_salas.nombre,ris_sedes.nombre as sede,case when ris_salas.idestado='2' then 'Inactivo' when ris_salas.idestado='1' then 'Activo' end estado")
            ->paginate();

        return view('ris.salas.index', compact('salas'));
    }

    public function create()
    {
        $user = Auth::user();
        $idcliente = Usuariosclientes::where('user_id', '=', $user->id)
            ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
            ->select('clientes.id')
            ->first();

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $sedes = ris_sedes::where('cliente_id', '=', $idcliente->id)->where('idestado', '1')->get();
        return view('ris.salas.create', compact('estados', 'sedes'));
    }


    public function store(Storeris_salas $request)
    {

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();



        ris_salas::create([
            'cliente_id' => $cu->cliente_id,
            'sede_id' => $request->sede_id,
            'nombre' => $request->nombre,
            'idestado' => $request->idestado
        ]);


        notify()->success('Sala Creada', 'Confirmacion');
        return redirect()->route('rissalas.create');
    }


    public function edit(ris_salas $sala)
    {
        $user = Auth::user();
        $idcliente = Usuariosclientes::where('user_id', '=', $user->id)
            ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
            ->select('clientes.id')
            ->first();


        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $sedes = ris_sedes::where('cliente_id', '=', $idcliente->id)->where('idestado', '1')->get();


        return view('ris.salas.edit', compact('sala', 'sedes', 'estados'));
    }
    public function update(Storeris_salas $request, ris_salas $sala)
    {



        $sala->update($request->all());

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        notify()->success('Sala Actualizada', 'Confirmacion');
        return redirect()->route('rissalas.edit', compact('sala',  'estados'));
    }


    public function destroy(ris_salas $sala)
    {


        $sala->delete();

        notify()->success('Sada Eliminada', 'Confirmacion');
        return redirect()->route('rissalas.index');
    }
}
