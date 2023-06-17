<?php

namespace App\Http\Controllers\estudios;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\usuariosclientes\Usuariosclientes;

class estudiosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }

        public function index() {

            $user = Auth::user();
            $institucion=Usuariosclientes::where('user_id','=',$user->id)
            ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
            ->select('clientes.ruta')
            ->first();

            $FechaInicial =Carbon::now()->setTimezone('America/Bogota');
            $FechaFinal =Carbon::now()->setTimezone('America/Bogota');
         

            return view('estudios.index',compact('institucion','FechaInicial','FechaFinal'));
        }

}
