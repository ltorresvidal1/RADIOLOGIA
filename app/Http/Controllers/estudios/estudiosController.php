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


  public function estudiosagendados()
  {

    $user = Auth::user();
    $institucion = Usuariosclientes::where('user_id', '=', $user->id)
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
      ->select('clientes.ruta')
      ->first();


    return view('estudios.estudiosagendados', compact('institucion'));
  }

  public function estudioscompletados()
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

  public function estudiosenproceso()
  {

    $user = Auth::user();
    $institucion = Usuariosclientes::where('user_id', '=', $user->id)
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
      ->select('clientes.ruta')
      ->first();



    return view('estudios.estudiosenproceso', compact('institucion'));
  }

  public function estudiosdeturno()
  {

    $user = Auth::user();
    $institucion = Usuariosclientes::where('user_id', '=', $user->id)
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
      ->select('clientes.ruta')
      ->first();


    return view('estudios.estudiosdeturno', compact('institucion'));
  }

  public function estudiosporvalidar()
  {

    $user = Auth::user();
    $institucion = Usuariosclientes::where('user_id', '=', $user->id)
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
      ->select('clientes.ruta')
      ->first();


    return view('estudios.estudiosporvalidar', compact('institucion'));
  }




  public function update_validado($idestudio)
  {
    lecturas::where('study_id', '=', $idestudio)->update(['validado' => 1]);
  }

  public function update_audio($idestudio)
  {
    $user = Auth::user();
    study::where('study_iuid', '=', $idestudio)->update(['conaudio' => 1, 'medico_id' => $user->id]);
  }
}
