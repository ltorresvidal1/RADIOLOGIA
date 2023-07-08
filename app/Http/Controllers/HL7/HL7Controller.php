<?php

namespace App\Http\Controllers\HL7;

use Aranyasen\HL7\Message;
use Illuminate\Http\Request;
use Aranyasen\HL7\Connection;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HL7Controller extends Controller
{




    public function login(Request $request)
    {

        //   $response = ['status' => 0, 'message' => ''];
        // $data = json_decode($request->getContent());

        //return response()->json([$data->luis]);

        //$credentials = $request->only('usuario', 'password');
        //$credentials['idestado'] = 1;


        //   if (!Auth::attempt($credentials)) {
        //     return response()->json(['message' => $request, 401]);
        //  }


        //return response()->json(['message' => $request, 401]);
        if (!Auth::attempt($request->only('usuario', 'password'))) {
            return response()->json(['message' => 'Usuario no autorizado', 'status' => 0]);
        } else {
            $user = User::where('usuario', $request['usuario'])->first();
            // $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['message' => "ok", 'status' => 1]);
        }




        //return response()->json(['accessToken' => $token]);
    }











    public function envioMWL()
    {


        //$ip = '192.168.1.73';
        $ip = '172.190.68.187';
        $port = '2575';

        $hl7String = 'MSH|^~\&|SIOS|SYSNET|HUNAD|HUNAD|202306111512||ORM^O01|459536|P|2.3.1||||||
PID|||22804862^^^CC||ALVAREZ HERRERA^EDELVI MARLENE||19450804|M||WH|820 JORIE BLVD^^CHICAGO^IL^60523|||||||20-98-4000|||||||||||||||||||||
PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|  
ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A||| 
OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||||||||| 
NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A';

        $message = new Message($hl7String);
        $message->toString(true);
        //$PID = $message->getSegmentsByName('PID');
        // $OBR = $message->getSegmentsByName('OBR');
        $OBR2 =  $message->getFirstSegmentInstance('OBR');

        dd($OBR2->getField(4)[0]);
        /*
         MSH|^~\&|MESA_OF|XYZ_RADIOLOGY|MESA_IM|XYZ_IMAGE_MANAGER|201605111512||ORM^O01|100112|P|2.3.1|||||| ||
PID|||M4001^^^ADT1||KING^MARTIN||19450804|M||WH|820 JORIE BLVD^^CHICAGO^IL^60523|||||||20-98-4000|||||||||||||||||||||
PV1||E|ED||||1234^WEAVER^TIMOTHY^P^^DR|5101^NELL^FREDERICK^P^^DR|0000^Consulting^Doctor^P^^DR|HSR|||||AS||0000^Admitting^Doctor^P^^DR||V100^^^ADT1|||||||||||||||||||||||||200008201100|||||||V|
ORC|NW|A100Z^MESA_ORDPLC|B100Z^MESA_ORDFIL||SC||1^once^^^^S||200008161510|^ROSEWOOD^RANDOLPH||7101^ESTRADA^JAIME^P^^DR|Enterer^^Location^EL^00000|(314)555-1212|200008161510||922229-10^IHE-RAD^IHE-CODE-231||
OBR|1|A100Z^MESA_ORDPLC|B100Z^MESA_ORDFIL|P1^Procedure 1^ERL_MESA^X1_A1^SP Action Item X1_A1^DSS_MESA|||||||||xxx||Radiology^^^^R|7101^ESTRADA^JAIME^P^^DR||$ACCESSION_NUMBER$|$REQUESTED_PROCEDURE_ID$|$SCHEDULED_PROCEDURE_STEP_ID$||||MR|||1^once^^^^S|||WALK|||||||||||A|||$PROCEDURE_CODE$
ZDS|1.2.4.0.13.1.432252867.1552647.1^100^Application^DICOM
  
        MSH|^~\&|SIOS|SYSNET|Hiruko|ImExHS|20230627111100||ORM^O01|459536||2.4|||||| 
        PID||CC^22804862|||ALVAREZ HERRERA^EDELVI MARLENE||19871203|F|O+||EL POZON^^001^13001^13^CO^P||3208714651|3174767825|||||  
        PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|  
        ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A||| 
        OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||||||||| 
        NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A
  
         */
        /* $hl7String = 'MSH|^~\&|SIOS|SYSNET|HUNAD|HUNAD|20230627111100||ORM^O01|459536|P|2.3.1||||||
PID||CC^22804862|M4001^^^ADT1||ALVAREZ HERRERA^EDELVI MARLENE||19871203|F|O+||EL POZON^^001^13001^13^CO^P||3208714651|3174767825|||||
PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|
ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A|||
OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1|||||||||||||||
NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A';
*/

        //$connection = new Connection($ip, $port);
        //$response = $connection->send($message);
        //dd($response->toString(true));



        /*

        ----- Plantilla HL7
        MSH|^~\&|SIOS|@Nombre_EmpresaMensaje|Hiruko|ImExHS|@Fecha_Orden||ORM^O01|@Numero_Examen||2.4||||||  
        PID||@Tipo_Id_Paciente^@Identificacion_Paciente|||@Apellidos_Paciente^@Nombres_Paciente||@Fecha_Nacimiento_Paciente|@Sexo_Paciente|@Grupo_Sanguineo||@Direccion_Paciente^^@Ciudad_Paciente^@Municipio_Paciente^@Departamento_Paciente^@Codigo_Pais_Paciente^P||@Telefono_Paciente|@Celular_Paciente|||||@CorreoPaciente   
        PV1||I|@Unidad_Funcional|||||||||||||||||||||||||||||||||||||||||@Fecha_Admision|   
        ORC|NW|@Nit_Empresa^@Nombre_Empresa||@Numero_Orden|SC||^^^@Fecha_Inicio^@Fecha_Finalizacion^1|||@Usuario_Doctor||@Codigo_Doctor^@Apellido_Doctor^@Nombre_Doctor|@Modalidad^@Codigo_Sala||||@Puesto_Atencion|||||@Nit_Administradora^@Nombre_Administradora|||  
        OBR||@Codigo_Interno^@Nit_Empresa^@Nombre_Empresa||@Cups^@Nombre_Cups||||||||||||@Procedencia|||||||||||||||
        
         ----- Ejemplo de HL7 de Envio
        MSH|^~\&|SIOS|SYSNET|Hiruko|ImExHS|20230627111100||ORM^O01|459536||2.4|||||| 
        PID||CC^22804862|||ALVAREZ HERRERA^EDELVI MARLENE||19871203|F|O+||EL POZON^^001^13001^13^CO^P||3208714651|3174767825|||||  
        PV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||20230627111100|  
        ORC|NW|806016225^CENTRO MEDICO BUENOS AIRES S.A.S||311234|SC||^^^20230627111100^20230627111100^1|||AVELILLA||94902672^VELILLA PERTUZ^ALVARO |^01||||01|||||9002267153^COOSALUD ENTIDAD PROMOTORA DE SALUD S.A||| 
        OBR||130010162601^806016225^CENTRO MEDICO BUENOS AIRES S.A.S||873204^Radiografia de hombro||||||||||||1||||||||||||||| 
        NTE|1|26715|COOSALUD ENTIDAD PROMOTORA DE SALUD S.A


        */
    }
}
