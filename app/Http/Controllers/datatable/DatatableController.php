<?php

namespace App\Http\Controllers\datatable;

use App\Models\pacs\series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DatatableController extends Controller
{



  public function estudiosportranscribir(string $institucion)
  {


    $estudios = series::where('institution', '=', "$institucion")
      ->where('study.conaudio', '=', '0')
      ->whereNotIn('study.study_iuid', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->selectRaw("series.modality as modalidad, concat('''',study_iuid,'''') as study_pk,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ') as nombre,
      pat_sex as  sexo,case when  study.prioridad is null then 0 else study.prioridad end as prioridad")
      ->distinct()->get();


    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }



  public function estudiosenproceso(string $institucion)
  {

    $user = Auth::user();

    $estudios = series::where('institution', '=', "$institucion")
      ->where('conaudio', '=', "1")
      ->where('medico_id', '=', $user->id)
      ->whereNotIn('study.study_iuid', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->selectRaw("series.modality as modalidad,concat('''',study_iuid,'''')  as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    replace (alphabetic_name,'^',' ')  as nombre,
    pat_sex as  sexo,case when  study.prioridad is null then 0 else study.prioridad end as prioridad")
      ->distinct()->get();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }


  public function estudiosporvalidar(string $institucion,)
  {
    $user = Auth::user();
    $estudios = series::where('institution', '=', "$institucion")
      ->where('lecturas.validado', '=', '0')
      ->where('lecturas.medico_id', '=', $user->id)
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->selectRaw("series.modality as modalidad,concat('''',study_iuid,'''')  as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    replace (alphabetic_name,'^',' ')  as nombre,
    pat_sex as  sexo,case when  study.prioridad is null then 0 else study.prioridad end as prioridad")
      ->distinct()->get();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }









  public function estudioscompetados(string $institucion, string $fechainicial, string $fechafinal)
  {

    $user = Auth::user();
    $estudios = series::where('institution', '=', "$institucion")
      ->where('lecturas.validado', '=', '1')
      ->where('lecturas.medico_id', '=', $user->id)
      ->whereRaw("study_date BETWEEN '$fechainicial' and '$fechafinal'")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->selectRaw("series.modality as modalidad,concat('''',study_iuid,'''')  as study_pk,study_iuid,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      replace (alphabetic_name,'^',' ')  as nombre,
      pat_sex as  sexo,case when  study.prioridad is null then 0 else study.prioridad end as prioridad")
      ->distinct()->get();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '<a title="Imprimir" onclick="ImprimirLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-warning rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-print text-white"></i> </div></a>';
      $acciones .= '<a href="http://192.168.1.73:3000/viewer?StudyInstanceUIDs=' . $estudios->study_iuid . '" target="_blank"  title="Ver Estudio" class="w-30px h-30px bg-gradient-teal rounded-circle d-flex align-items-center justify-content-center "><div class=""><i class="fa fa-binoculars text-white"></i> </div> </a>';
      $acciones .= '<a title="Decargar Cd" href="descargar_cd" class="w-30px h-30px bg-gradient-purple rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-download text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }




  public function lecturasestudiosclientes(string $institucion, string $idestudio)
  {


    $estudios = series::where('institution', '=', "$institucion")
      ->where('study.study_iuid', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.study_iuid')
      ->selectRaw("lecturas.id as lecturas_id,lecturas.estudio as estudio,regexp_replace(lecturas.informe, E'<[^>]+>', ' ', 'gi') as informe,lecturas.fechaestudio as fechaestudio,lecturas.informe as informe_html")
      ->distinct()->get();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Validar" onclick="ValidarLectura()" class="w-30px h-30px bg-gradient-success rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-check text-white"></i> </div></a>';
      $acciones .= '<a title="Editar" onclick="EditarLectura()" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '<a title="Imprimir" onclick="ImprimirLectura()" class="w-30px h-30px bg-gradient-warning rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-print text-white"></i> </div></a>';
      $acciones .= '<a title="Eliminar" onclick="EliminarLectura2(' . $estudios->lecturas_id . ')" class="w-30px h-30px bg-gradient-danger rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-trash-alt text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }
}
