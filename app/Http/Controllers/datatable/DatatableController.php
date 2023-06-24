<?php

namespace App\Http\Controllers\datatable;

use App\Models\pacs\series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatatableController extends Controller
{



  public function estudiosportranscribir(string $institucion, string $fechainicial, string $fechafinal)
  {


    $estudios = series::where('institution', '=', "$institucion")
      ->whereRaw("study_date BETWEEN '$fechainicial' and '$fechafinal'")
      ->whereNotIn('study.pk', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pk')
      ->selectRaw("series.modality as modalidad,study.pk as study_pk,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      concat(person_name.family_name ,' ',person_name.given_name ,' ' ,person_name.middle_name,' ' , person_name.name_prefix) as nombre,
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



  public function estudiosenproceso(string $institucion, string $fechainicial, string $fechafinal)
  {

    $estudios = series::where('institution', '=', "$institucion")
      ->where('conaudio', '=', "1")
      ->whereRaw("study_date BETWEEN '$fechainicial' and '$fechafinal'")
      ->whereNotIn('study.pk', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pk')
      ->selectRaw("series.modality as modalidad,study.pk as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    concat(person_name.family_name ,' ',person_name.given_name ,' ' ,person_name.middle_name,' ' , person_name.name_prefix) as nombre,
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


  public function estudiosporvalidar(string $institucion, string $fechainicial, string $fechafinal)
  {

    $estudios = series::where('institution', '=', "$institucion")
      ->whereRaw("study_date BETWEEN '$fechainicial' and '$fechafinal'")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.pk')
      ->selectRaw("series.modality as modalidad,study.pk as study_pk,patient.pk ,patient_id.pat_id,
    concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
    concat(person_name.family_name ,' ',person_name.given_name ,' ' ,person_name.middle_name,' ' , person_name.name_prefix) as nombre,
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









  public function estudiosclientes(string $institucion, string $fechainicial, string $fechafinal)
  {


    $estudios = series::where('institution', '=', "$institucion")
      ->whereRaw("study_date BETWEEN '$fechainicial' and '$fechafinal'")
      /*   ->whereNotIn('study.pk', function ($query) {
        $query->select('lecturas.study_id')->from('lecturas');
      })
     */
      //->whereRaw("lecturas BETWEEN '$fechainicial' and '$fechafinal'")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pk')
      /// ->leftjoin('lecturas', 'lecturas.study_id', '=', 'study.pk')
      ->selectRaw("series.modality as modalidad,study.pk as study_pk,patient.pk ,patient_id.pat_id,
      concat( SUBSTRING(study.study_date, 7, 2) ,'/',SUBSTRING(study.study_date, 5, 2) ,'/',SUBSTRING(study.study_date, 0, 5)) as fecha,
      concat(person_name.family_name ,' ',person_name.given_name ,' ' ,person_name.middle_name,' ' , person_name.name_prefix) as nombre,
      pat_sex as  sexo,case when  study.prioridad is null then 0 else study.prioridad end as prioridad")
      ->distinct()->get();
    //
    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Lectura" onclick="RealizarLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '<a title="Imprimir" onclick="ImprimirLecturas(' . $estudios->study_pk . ')" class="w-30px h-30px bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-print text-white"></i> </div></a>';
      $acciones .= '<a title="Ver Estudio" class="w-30px h-30px bg-teal rounded-circle d-flex align-items-center justify-content-center "><div class=""><i class="fa fa-binoculars text-white"></i> </div> </a>';
      $acciones .= '<a title="Decargar Cd" href="descargar_cd" class="w-30px h-30px bg-gray-500 rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-download text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }




  public function lecturasestudiosclientes(string $institucion, string $idestudio)
  {


    $estudios = series::where('institution', '=', "$institucion")
      ->where('study.pk', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('lecturas', 'lecturas.study_id', '=', 'study.pk')
      ->selectRaw("lecturas.id as lecturas_id,lecturas.estudio as estudio,regexp_replace(lecturas.informe, E'<[^>]+>', ' ', 'gi') as informe,lecturas.fechaestudio as fechaestudio,lecturas.informe as informe_html")
      ->distinct()->get();

    return datatables()->of($estudios)->addColumn('action', function ($estudios) {
      $acciones = '<div class="text-center">';
      $acciones = '<div class="btn-group">';
      $acciones .= '<a title="Editar" onclick="EditarLectura()" class="w-30px h-30px bg-gradient-info rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-edit text-white"></i> </div></a>';
      $acciones .= '<a title="Eliminar" onclick="EliminarLectura2(' . $estudios->lecturas_id . ')" class="w-30px h-30px bg-gradient-danger rounded-circle d-flex align-items-center justify-content-center"><div class=""><i class="fa fa-trash-alt text-white"></i> </div></a>';
      $acciones .= '</div>';
      $acciones .= '</div>';
      return $acciones;
    })->rawColumns(['action'])->make(true);
  }
}

    /*

        //<a href="{{ route('clientes.edit', $cliente->id) }}" class="dropdown-item"><i class="far fa-edit fa-fw fa-lg"></i> Editar</a>

        $estudios=series::where('institution','=','CAMINOS IPS')
   
   
   
      ->select('rips_maestros.*','users.nombre as usuario')->get();
      $consultaestudios= "select DISTINCT T2.pk,T2.pat_id,T2.nombre,T2.study_date,T2.study_iuid,T2.idestudio,T2.entidad,lec.idmedico,T2.edad,T2.correo
        from  dblink('dbname=pacsdb user=pacs password=pacs','
        select pa.pk ,pi.pat_id,concat(pn.family_name ,'' '',pn.given_name , '' '' ,pn.middle_name  , '' '' , pn.name_prefix) as nombre,
        st.study_date,st.study_iuid,st.pk idestudio,st.entidad,date_part(''year'',age( CAST ( pa.pat_birthdate AS date ))) edad,st.correo
        from patient pa,study st,person_name pn ,patient_id pi
        where  pa.pk=st.patient_fk and pa.patient_id_fk=pi.pk and pa.pk=pn.pk') as T2
        (pk text,pat_id text,nombre text,study_date date,study_iuid text,idestudio integer,entidad text,edad text,correo integer)
        left join lecturas lec on lec.idestudio=T2.idestudio
        where study_date BETWEEN '".$fechainicial."' and '".$fechafinal."' order by study_date asc'
*/
