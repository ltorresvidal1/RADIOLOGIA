<?php

namespace App\Http\Controllers\lecturas;

use notify;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Barryvdh\DomPDF\PDF;
use App\Models\pacs\series;
use App\Models\pacs\patient;
use Illuminate\Http\Request;
use App\Models\lecturas\lecturas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\lecturas\Storelecturas;
use App\Http\Requests\lecturas\Storelecturas2;
use App\Models\usuariosclientes\Usuariosclientes;

class lecturasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }



  public function index(string $idestudio)
  {

    $FechaActual = Carbon::now()->setTimezone('America/Bogota');


    $user = Auth::user();
    $institucion = Usuariosclientes::where('user_id', '=', $user->id)
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
      ->select('clientes.ruta')
      ->first();


    $estudio = series::where('institution', '=', "$institucion->ruta")
      ->where('study.pk', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->distinct()->count('study.pk');


    $datospaciente = series::where('institution', '=', "$institucion->ruta")
      ->where('study.pk', '=', "$idestudio")
      ->join('study', 'study.pk', '=', 'series.study_fk')
      ->join('patient', 'patient.pk', '=', 'study.patient_fk')
      ->join('patient_id', 'patient_id.pk', '=', 'patient.patient_id_fk')
      ->join('person_name', 'person_name.pk', '=', 'patient.pat_name_fk')
      ->selectRaw("concat(family_name,' ',given_name,' ',middle_name,' ',name_prefix) as nombrepaciente,
      patient_id.pat_id as documento,
      case when pat_sex='M' then 'Masculino' when pat_sex='F' then 'Femenimo'  ELSE 'Sin Diligenciar' END  sexo,
      case when pat_birthdate='*' then 0  ELSE date_part('year',age( CAST (pat_birthdate AS date ))) end as edad_a,
      case when pat_birthdate='*' then 0  ELSE date_part('month',age( CAST (pat_birthdate AS date ))) end as edad_m,
      case when pat_birthdate='*' then 0  ELSE date_part('day',age( CAST (pat_birthdate AS date ))) end as edad_d
      ")->first();

    //dd($datospaciente);

    $lecturas = lecturas::where('study_id', '=', "$idestudio")->get();



    if ($estudio == 1) {
      return view('lectura.index', compact('institucion', 'FechaActual', 'idestudio', 'lecturas', 'datospaciente'));
    } else {
      return redirect()->back();
    }
  }

  public function store(Storelecturas $request)
  {
    $FechaActual = Carbon::now()->setTimezone('America/Bogota');
    $idestudio = $request->estudio;

    lecturas::create([
      'study_id' => $request->idestudio,
      'medico_id' => 1,
      'estudio' => $request->estudio,
      'informe' => $request->informe,
      'fechaestudio' => $request->fechaestudio,
    ]);

    notify()->success('', 'Lectura Guardada');
    return redirect()->back();
  }


  public function update(Request $request)
  {


    $validator = Validator::make($request->all(), [
      'estudio2' => 'required',
      'informe2' => 'required',
      'fechaestudio2' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()->all()]);
    }

    $lectura = lecturas::find($request->idestudio2);
    $lectura->estudio = $request->estudio2;
    $lectura->informe = $request->informe2;
    $lectura->fechaestudio = $request->fechaestudio2;
    $lectura->save();
    return redirect()->back()->with('actualizo', 'ok');;
  }
  public function destroy($idlectura)
  {

    $lectura = lecturas::find($idlectura);
    $lectura->delete();

    //return redirect()->back(); 

  }

  public function DescargarPdfAgrupado()
  {
    $idestudio = '1663';

    $user = Auth::user();
    $cliente = Usuariosclientes::where('user_id', '=', $user->id)
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
      ->select('clientes.*')
      ->first();



    $lecturas = lecturas::where('study_id', '=', "$idestudio")->first();
    $pdf = app('dompdf.wrapper');
    $pdf->loadView('lectura.descargarPdfAgrupado', ['lecturas' => $lecturas, 'clientes' => $cliente]);

    return $pdf->stream();
  }
}


/*
//echo $response->getBody();
dd( $response->getBody());
*/
/*    $identificacion = 'CC';
      $tipoidentificacion = '137247124';
      $Password = 'Pruebas123';
      
      $response = Http::post('http://zafiroapi.sispropreprod.gov.co:8081/api/Login');
*//*

      $client = new Client(); 
      $headers = ['Content-Type' => 'application/json'];  
      
      $body = '{"tipoIdentificacion": "CC","Identificacion": "137247124","Password": "Pruebas123"}';
      
      $request = $client->request('POST', 'http://zafiroapi.sispropreprod.gov.co/api/Login', $headers, $body);
    //  $res = $client->sendAsync($request)->wait();
      echo $request->getBody();
    ]

    */
/*
      $client = new Client();
      $headers = [
  'Content-Type' => 'application/json'
];
$body = '{
  "tipoIdentificacion": "CC",
  "Identificacion": "137247124",
  "Password": "Pruebas123"
}';
*/
//$request = Http::post('http://zafiroapi.sispropreprod.gov.co:8081/api/Login');
//$request = new Request('POST', 'http://zafiroapi.sispropreprod.gov.co/api/Login', $headers, $body);
//$res = $client->sendAsync($request)->wait();
//echo $res->getBody();
/*
$response = Http::withHeaders([
  'Content-Type' => 'application/json'
])->post('http://zafiroapi.sispropreprod.gov.co:8081/api/Login', ['body'=>[
  'tipoIdentificacion'=>'CC',
  'Identificacion'=>'137247124',
  'Password'=>'Pruebas123']
]);


$LoginArray = [];
*/

//   $pdf->loadHTML('<h1> hola</h1>');
/*
      view()->share('lectura.descargarPdfAgrupado',$lecturas);
      $pdf = PDF::loadView('lectura.descargarPdfAgrupado', ['lecturas' => $lecturas]);

     return $pdf->download('lecturas');
*/


/*   $pdf->loadView('lectura.descargarPdfAgrupado', ['lecturas' => $lecturas]);
     $fileName = $lecturas;
     return $pdf->stream($fileName.'.pdf');
*/
//dd($lecturas->id);

/* $lectura->update([
      'estudio'=>$request->estudio2,
      'informe'=>$request->informe2,
      'fechaestudio'=>$request->fechaestudio2,
    ]);

    */




//  $affectedRows = lecturas::where('id', '=', $request->idlectura)->update(array('estudio' => 'Perfecto 22222'));

/*  $query = "update `parametros` set `pesos` = '$kilos[$i]',edad='$edad[$i]',`valor` = '$valor[$i]',`porcentaje` = IFNULL('$porcentaje[$i]',0) where `finca_id` = '$parametrizacion->idfinca' and `estadoProduccion` = '$tipos[$i]';";
      DB::getPdo()->exec($query); 

      lecturas::updated([
        'estudio'=>'perfecto',
        'informe'=>'sin definir',
     //   'fechaestudio'=>'',
      ]);
     */

// dd('HOLA');
//dd($request);



/**
 * 
 *     
       
 */

      //notify()->success('','Lectura Actualizada');        
     // return redirect()->back();
   
  
   /*
     public function destroy(lecturas $lectura){

       $lectura->delete();
   //   return redirect()->back(); 
     
     }
     */

 //,ToastrFactory $msn
     //$builder = $msn->type('error')->title(' ')->message('cliente Eliminado')->positionClass('toast-bottom-right')->preventDuplicates(true)->timeOut(2000);$builder->flash();    
     //return response()->json(['success'=>'Eliminado']);
    // return redirect()->route('clientes.index');
    //return redirect()->back();