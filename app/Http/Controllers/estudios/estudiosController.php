<?php

namespace App\Http\Controllers\estudios;

use Carbon\Carbon;
use App\Models\pacs\study;
use Illuminate\Http\Request;
use App\Models\lecturas\lecturas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\usuariosclientes\Usuariosclientes;

class estudiosController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {

    $user = Auth::user();
    $institucion = Usuariosclientes::where('user_id', '=', $user->id)
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
      ->select('clientes.ruta')
      ->first();

    $FechaInicial = Carbon::now()->setTimezone('America/Bogota');
    $FechaFinal = Carbon::now()->setTimezone('America/Bogota');


    return view('estudios.index', compact('institucion', 'FechaInicial', 'FechaFinal'));
  }
  public function update_audio($idestudio)
  {
    study::where('pk', '=', $idestudio)->update(['conaudio' => 1]);
  }
}
