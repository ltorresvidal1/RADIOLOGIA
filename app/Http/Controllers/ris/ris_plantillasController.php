<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_plantillas;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_plantillas;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_plantillasController extends Controller
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

        $plantillas = ris_plantillas::where('cliente_id', '=', $idcliente->id)
            ->selectRaw("id,nombre,case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->paginate();

        return view('ris.plantillas.index', compact('plantillas'));
    }

    public function create()
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.plantillas.create', compact('estados'));
    }


    public function store(Storeris_plantillas $request)
    {

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();



        ris_plantillas::create([
            'cliente_id' => $cu->cliente_id,
            'nombre' => $request->nombre,
            'plantilla' => $request->plantilla,
            'idestado' => $request->idestado

        ]);


        notify()->success('Plantilla Creada', 'Confirmacion');
        return redirect()->route('plantillas.create');
    }


    public function edit(ris_plantillas $plantilla)
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.plantilla.edit', compact('plantilla', 'estados'));
    }
    public function update(Storeris_plantillas $request, ris_plantillas $plantilla)
    {



        $plantilla->update($request->all());

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        notify()->success('Plantilla Actualizada', 'Confirmacion');

        return redirect()->route('risplantillas.edit', compact('plantilla',  'estados'));
    }


    public function destroy(ris_plantillas $plantilla)
    {


        $plantilla->delete();

        notify()->success('Plantilla Eliminada', 'Confirmacion');
        return redirect()->route('risplantillas.index');
    }
}
