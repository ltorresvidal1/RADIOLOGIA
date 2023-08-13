<?php

namespace App\Http\Controllers\principal;

use App\Models\pacs\series;
use Illuminate\Support\Arr;
use App\Models\pacs\patient;
use Illuminate\Http\Request;
use App\Models\pacs\patient_id;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\usuariosclientes\Usuariosclientes;

class PrincipalController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function index()
  {


    $user = Auth::user();
    $valeresmeses = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];



    if ($user->perfile_id == '1') {

      $consultapacientes = series::join('study', 'study.pk', '=', 'series.study_fk')
        ->join('patient', 'patient.pk', '=', 'study.patient_fk')
        ->distinct()->count('patient.pk');

      $consultaestudios = series::count();

      $tamanoendisco = series::join('instance', 'instance.series_fk', '=', 'series.pk')
        ->join('location', 'location.instance_fk', '=', 'instance.pk')
        ->selectRaw('round((sum(object_size)/100000000000)*100,2) as total')
        ->pluck('total');


      $consultaestudiospormes = series::whereRaw('SUBSTRING (study.study_date ,1 ,4)=CAST (extract(year from now()) AS text)')
        ->groupByRaw('SUBSTRING(study.study_date ,5 ,2 )')
        ->join('study', 'study.pk', '=', 'series.study_fk')
        ->selectRaw('count(*) as total,  SUBSTRING(study.study_date, 5, 2) as mes')->get();

      $numero = count($consultaestudiospormes, COUNT_RECURSIVE);


      for ($i = 0; $i < $numero; $i++) {
        if ($consultaestudiospormes[$i]->mes == '01') {
          $valeresmeses[0] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '02') {
          $valeresmeses[1] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '03') {
          $valeresmeses[2] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '04') {
          $valeresmeses[3] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '05') {
          $valeresmeses[4] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '06') {
          $valeresmeses[5] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '07') {
          $valeresmeses[6] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '08') {
          $valeresmeses[7] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '09') {
          $valeresmeses[8] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '10') {
          $valeresmeses[9] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '11') {
          $valeresmeses[10] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '12') {
          $valeresmeses[11] == $consultaestudiospormes[$i]->total;
        }
      }

      return view('adprincipal', compact('consultapacientes', 'consultaestudios', 'valeresmeses', 'tamanoendisco'));
    }
    if ($user->perfile_id == '2') {


      $institucion = Usuariosclientes::where('user_id', '=', $user->id)
        ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
        ->select('clientes.ruta')
        ->first();

      $consultapacientes = series::where('institution', '=', "$institucion->ruta")
        ->join('study', 'study.pk', '=', 'series.study_fk')
        ->join('patient', 'patient.pk', '=', 'study.patient_fk')
        ->distinct()->count('patient.pk');

      $consultaestudios = series::where('institution', '=', "$institucion->ruta")->count();

      $tamanoendisco = series::where('institution', '=', "$institucion->ruta")
        ->join('instance', 'instance.series_fk', '=', 'series.pk')
        ->join('location', 'location.instance_fk', '=', 'instance.pk')
        ->selectRaw('round((sum(object_size)/100000000000)*100,2) as total')
        ->pluck('total');


      $consultaestudiospormes = series::where('institution', '=', "$institucion->ruta")
        ->whereRaw('SUBSTRING (study.study_date ,1 ,4)=CAST (extract(year from now()) AS text)')
        ->groupByRaw('SUBSTRING(study.study_date ,5 ,2 )')
        ->join('study', 'study.pk', '=', 'series.study_fk')
        ->selectRaw('count(*) as total,  SUBSTRING(study.study_date, 5, 2) as mes')->get();

      $numero = count($consultaestudiospormes, COUNT_RECURSIVE);


      for ($i = 0; $i < $numero; $i++) {
        if ($consultaestudiospormes[$i]->mes == '01') {
          $valeresmeses[0] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '02') {
          $valeresmeses[1] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '03') {
          $valeresmeses[2] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '04') {
          $valeresmeses[3] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '05') {
          $valeresmeses[4] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '06') {
          $valeresmeses[5] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '07') {
          $valeresmeses[6] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '08') {
          $valeresmeses[7] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '09') {
          $valeresmeses[8] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '10') {
          $valeresmeses[9] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '11') {
          $valeresmeses[10] = $consultaestudiospormes[$i]->total;
        }
        if ($consultaestudiospormes[$i]->mes == '12') {
          $valeresmeses[11] == $consultaestudiospormes[$i]->total;
        }
      }

      return view('principal', compact('consultapacientes', 'consultaestudios', 'valeresmeses', 'tamanoendisco'));
    }
    if ($user->perfile_id == '3') {

      $institucion = Usuariosclientes::where('user_id', '=', $user->id)
        ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
        ->select('clientes.ruta')
        ->first();

      return view('estudios.estudiosagendados', compact('institucion'));
    }
  }
}
