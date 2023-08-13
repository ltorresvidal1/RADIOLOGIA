
<!DOCTYPE html>
<html lang="es">
  <head>
    <link rel="shortcut icon" href="/uploads/logos/hunab_icono.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resultado</title>

    

    <style>
        
  
      *{ font-family: DejaVu Sans !important;}
      .clearfix:after {
        content: "";
        display: table;
        clear: both;
      } 
     
      body {
        position: relative;
        width: 19cm;  
        height: 29.7cm; 
        margin: 0 auto; 
        background: #FFFFFF; 
        font-family: SourceSansPro !important;
        font-size: 14px; 
      }
  
      header {
        padding: 10px 0;
        margin-bottom: 5px;
        border-bottom: 1px solid #AAAAAA;
      
      }

      #company {
        float: right;
        text-align: right;
        font-family: SourceSansPro !important;
        margin-top: -30px;
      }
         
      #details {
        margin-bottom: 1px;
        font-family: SourceSansPro !important;
      }
      
          
      #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
        font-family: SourceSansPro !important;
      }

       
      #logo {
        float: left;
        margin-top: -40px;
      }
      
      #logo img {
        width: 120px;
        height: 120px;
      }
      

      #invoice {
        float: right;
        text-align: right;
      }
      
      #invoice h1 {
        color: #0087C3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
      }
      
      #invoice .date {
        font-size: 1.1em;
        color: #777777;
      }
       
      h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
        text-transform: uppercase;
      }
      h4.name {
        margin: 0;
        font-weight: normal;
        text-transform: uppercase;
      }
      
        #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;  
       
      }
      footer {
        width: 50%;
        height: 30px;
        position: absolute;
        bottom: 250;
        padding: 8px 0;
        text-align: center;
        font-size: 11px;
       
      }
    


    .grid-block{
      margin-top: -60px;
      background-image: url("{{ public_path() . "/uploads/firmasradiologos/". $lecturas->firma }}"); 
      background-repeat: no-repeat;
      background-size: 100px;
      height: 200%;
    }
 
    p {
      line-height: 0.1cm; 
    }
  
    
    </style>      


  </head>
  <body>
    <header class="clearfix">
      
      <div id="logo">
        <img src="{{ public_path() . "/uploads/clienteslogos/". $clientes->logo }}">
      </div>
   
      
      <div id="company">
        <h2 class="name">{{ $clientes->nombre }}</h2>
        <div>NIT :{{ $clientes->nit }}</div>
        <div>{{ $clientes->direccion }}</div>
        <div>{{ $clientes->telefono }}</div>
        <div>{{ $clientes->correo }}</div>
      </div>
   
    </header>
    <main>
     
      <div id="details" class="clearfix">
        <div id="client">
          <h4 class="name"><b>ESTUDIO :</b> {{ $lecturas->estudio}} </h4>
          <h4 class="name"><b>NOMBRE :</b>{{ $datospaciente->nombrepaciente}}</h4>
          <h4 class="name"><b>DOCUMENTO :</b>{{ $datospaciente->documento}}</h4>
          <h4 class="name"><b>FECHA ESTUDIO :</b>   {{ $datospaciente->fechaestudio }}</>
          <h4 class="name"><b>ENTIDAD :</b></h4>
        </div>
      </div>

      <p>{!! $lecturas->informe !!}</p>


  
     
  
</main>
    
    <footer>

    
      <table  width="530">
        <thead>
        <tr>
         
          <th ><img width="35%" height="70px" style="border: 1px" src="{{ public_path() . "/uploads/firmasradiologos/". $lecturas->firma }}"></th>
          <td  width="45%" style="text-align: center;"></td>
        </tr>
        </thead>
     
        </table>

        <table  width="530">
       
        <thead>
          <tr>
            <td  style="text-align: center;vertical-align: top;"  width="55%"  rowspan="5">
          
              <div>Informe firmado electrónicamente por:</div>
              <div><strong> {{ $lecturas->radiologo }}</strong> </div>
              <div><strong>RADIOLOGO</strong></div>
              <div><strong>N° REGISTRO:  {{ $lecturas->registro }}</strong></div>
              <div><strong>Fecha y hora de firma: 23-09-2021 08:00</strong></div>
            </td>
            <td  width="45%" style="text-align: center;"   rowspan="4">  <img src="data:image/png;base64, {!! $qrcode !!}"></td>
          </tr>
          <tr>
           
          </tr>
          <tr>
          </tr>
          <tr>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><div id="notices">
              <div class="notice"> <strong> Nota:</strong> Consulte su imagen escaneando el codigo.</div>
            </div></td>
          </tr>
        </tbody>
        </table>

        <table width="530">
      
          <thead>
            <tr>
              <td  width="55%" style="text-align: center;" rowspan="4">  
               
              </td>
              <td width="45%" rowspan="4"></td>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
          </thead>
          </table>
   

    </footer>

 

  
    
	<script type="text/php">
    
        
        if ( isset($pdf) ) {
            date_default_timezone_set('America/Bogota');
            $pdf->page_script('
            
                $hoy = date("Y-m-d H:i:s"); 
                $ano = date("Y"); 

                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(20, 815, "copyright © $ano Hunab tecnologia S.A.S", $font, 6);
                $pdf->text(270, 820, "Pág $PAGE_NUM/$PAGE_COUNT", $font, 8);
                $pdf->text(410, 820, "Fecha/Hora de impresion $hoy", $font, 6);
            ');
        }
    	</script>


  </body>
</html>