
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>

    

    <style>
        
    @font-face {
        font-family: SourceSansPro;
        src: url(SourceSansPro-Regular.ttf);
      }
    
      .clearfix:after {
        content: "";
        display: table;
        clear: both;
      } /*
      */
      /*
      a {
        color: #0087C3;
        text-decoration: none;
      }
      */
       
      body {
        position: relative;
        width: 19cm;  
        height: 29.7cm; 
        margin: 0 auto; 
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 14px; 
        font-family: SourceSansPro;
      }
  
      header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
      }

      #company {
        float: right;
        text-align: right;
      }
         
      #details {
        margin-bottom: 50px;
      }
      
          
      #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
      }
      
      #client .to {
        color: #777777;
      }
       
      #logo {
        float: left;
        margin-top: 0px;
      }
      
      #logo img {
        height: 100px;
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
      }
      
     /*
      table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
      }
      
      table th,
      table td {
        padding: 20px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
      }
      
      table th {
        white-space: nowrap;        
        font-weight: normal;
      }
      
      table td {
        text-align: right;
      }
      
      table td h3{
        color: #57B223;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
      }
      
      table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        background: #57B223;
      }
      
      table .desc {
        text-align: left;
      }
      
      table .unit {
        background: #DDDDDD;
      }
      
      table .qty {
      }
      
      table .total {
        background: #57B223;
        color: #FFFFFF;
      }
      
      table td.unit,
      table td.qty,
      table td.total {
        font-size: 1.2em;
      }
      
      table tbody tr:last-child td {
        border: none;
      }
      
      table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap; 
        border-top: 1px solid #AAAAAA; 
      }
      
      table tfoot tr:first-child td {
        border-top: none; 
      }
      
      table tfoot tr:last-child td {
        color: #57B223;
        font-size: 1.4em;
        border-top: 1px solid #57B223; 
      
      }
      
      table tfoot tr td:first-child {
        border: none;
      }
      
      #thanks{
        font-size: 2em;
        margin-bottom: 50px;
      }
      
      #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;  
      }
      
      #notices .notice {
        font-size: 1.2em;
      }
        */
      footer {
        width: 50%;
        height: 30px;
        position: absolute;
        bottom: 150;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
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
        <div>{{ $clientes->direccion }}</div>
        <div>{{ $clientes->telefono }}</div>
        <div>{{ $clientes->correo }}</div>
      </div>
   
    </header>
    <main>
     
      <div id="details" class="clearfix">
        <div id="client">
          <div class="name"><b>ESTUDIO :</b>{{ $lecturas->estudio}}</div>
          <div class="name"><b>NOMBRE :</b></div>
          <div class="name"><b>DOCUMENTO :</b></div>
          <div class="name"><b>FECHA ESTUDIO :</b>{{ $lecturas->fechaestudio }}</div>
          <div class="name"><b>ENTIDAD :</b></div>
        </div>
        <!--
        <div id="invoice">
            <div class="name">ESTUDIO :</div>
            <div class="name">ESTUDIO :</div>
            <div class="name">ESTUDIO :</div>
        </div>
    -->

      </div>

      <div>{!! $lecturas->informe !!}</div>
      

      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
  
    </main>
    
    <footer>
        <div>informe firmado electrónicamente por:</div>
        <div>NOTICE:</div>
        <div>NOTICE:</div>
        <div>NOTICE:</div>
        <div>NOTICE:</div>
      </footer>

    
	<script type="text/php">
       
        
        if ( isset($pdf) ) {
            date_default_timezone_set('America/Bogota');
            $pdf->page_script('
            
                $hoy = date("Y-m-d H:i:s"); 
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(20, 815, "Radiology.ggiab Desarrollador por: Luis Gabriel Torres Vidal. Cel:3215794352 ", $font, 7);
                $pdf->text(270, 820, "Pág $PAGE_NUM/$PAGE_COUNT", $font, 10);
                $pdf->text(410, 820, "Fecha/Hora de impresion $hoy", $font, 8);
            ');
        }
    	</script>


  </body>
</html>