@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">
		<link href="/assets/js/plugins/summernote/css/summernote-lite.css" rel="stylesheet" />
        
        
@endpush


@extends('layouts.plantillaEstudios', [
  'appTopNav' => true,
  'appClass' => 'app-sidebar-minified'
])

@section('title','RADIOLOGIA')
@section('tituloformulario','Estudios')



@section('content')



<div class="card">
    <ul class="nav nav-tabs nav-tabs-v2 px-4" role="tablist">
    <li class="nav-item me-3" role="presentation"><a href="#tab1" class="nav-link px-2 active" data-bs-toggle="tab" aria-selected="true" role="tab">Todos</a></li>
    <li class="nav-item me-3" role="presentation"><a href="#tab2" class="nav-link px-2" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Por Trascribir</a></li>
    <li class="nav-item me-3" role="presentation"><a href="#tab3" class="nav-link px-2" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">En Proceso</a></li>
    <li class="nav-item me-3" role="presentation"><a href="#tab4" class="nav-link px-2" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Por Validar</a></li>
    <li class="nav-item me-3" role="presentation"><a href="#tab5" class="nav-link px-2" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Completados</a></li>
    <li class="nav-item me-3" role="presentation"><a href="#tab6" class="nav-link px-2" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Anulados</a></li>
    </ul>
        <div class="tab-content p-4">
            <div class="tab-pane fade active show" id="tab1" role="tabpanel">


                <div class="row">		
                    <div class="form-group col-11 m-0">		
                    </div>									                                                    
                    <div class="form-group col-1 m-0">
                        <button type="button" class="btn btn-primary mb-1 btn-sm" data-bs-toggle="modal" data-bs-target="#modalSm">
                            <i class="fa fa-cog"></i> Filtros
                        </button>
                    </div>
                </div>

                <div class="row">            
                    <table id="datatableDefault" class="table text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id Estudio</th>
                                <th>Fecha Estudio</th> 
                                <th><h6>Paciente</h6> <small>Nombre, identificación, sexo</small></th>
                                <th>Modalidad</th>
                                <th>Prioridad</th>
                                <th>Acciones</th>                                                     
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>       
                </div>
                <div class="input-group mb-4">
                 
                </div>



            </div>

            <div class="tab-pane fade show" id="tab2" role="tabpanel">
              
                <div class="row">		
                    <div class="form-group col-5 m-0">		
                    </div>	
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="fechainicial">Fecha Inicial</label>
                        <input type="date" class="form-control  @error('fechainicial') is-invalid @enderror" value="{{$FechaInicial->format('Y-m-d')}}"  id="fechainicial" name="fechainicial"/>
                        @error('fechainicial')
                            <br>
                            <small>*{{$message}}</small>
                            <br>
                        @enderror
                    </div>
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="fechafinal">Fecha Final</label>
                        <input type="date"   @error('fechafinal') class="form-control is-invalid" @enderror
                        class="form-control"  id="fechafinal" name="fechafinal"  value="{{$FechaFinal->format('Y-m-d')}}"/>
                        @error('fechafinal')
                        <br>
                        <small>*{{$message}}</small>
                        <br>
                    @enderror
                    </div>   
                   
                   								                                                    
                    <div class="form-group col-1 m-0">
                        <button type="button" class="btn btn-primary mb-1 btn-sm" data-bs-toggle="modal" data-bs-target="#modalSm">
                            <i class="fa fa-cog"></i> Filtros
                        </button>
                    </div>
                </div>

                <br>
                <div class="row">            
                    <table id="tabletab2" class="table text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id Estudio</th>
                                <th>Fecha Estudio</th> 
                                <th></th>
                                <th><h6>Paciente</h6> <small>Nombre, identificación, sexo</small></th>
                                <th>Sexo</th>
                                <th>Modalidad</th>
                                <th>Prioridad</th>
                                <th>Acciones</th>                                                     
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>       
                </div>
            </div>

            <div class="tab-pane fade show" id="tab3" role="tabpanel">
              
                <div class="row">		
                    <div class="form-group col-5 m-0">		
                    </div>	
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="fechainicial3">Fecha Inicial</label>
                        <input type="date" class="form-control  @error('fechainicial3') is-invalid @enderror" value="{{$FechaInicial->format('Y-m-d')}}"  id="fechainicial3" name="fechainicial3"/>
                        @error('fechainicial3')
                            <br>
                            <small>*{{$message}}</small>
                            <br>
                        @enderror
                    </div>
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="fechafinal3">Fecha Final</label>
                        <input type="date"   @error('fechafinal3') class="form-control is-invalid" @enderror
                        class="form-control"  id="fechafinal3" name="fechafinal3"  value="{{$FechaFinal->format('Y-m-d')}}"/>
                        @error('fechafinal3')
                        <br>
                        <small>*{{$message}}</small>
                        <br>
                    @enderror
                    </div>   
                   
                   								                                                    
                    <div class="form-group col-1 m-0">
                        <button type="button" class="btn btn-primary mb-1 btn-sm" data-bs-toggle="modal" data-bs-target="#modalSm">
                            <i class="fa fa-cog"></i> Filtros
                        </button>
                    </div>
                </div>

                <br>
                <div class="row">            
                    <table id="tabletab3" class="table text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id Estudio</th>
                                <th>Fecha Estudio</th> 
                                <th></th>
                                <th><h6>Paciente</h6> <small>Nombre, identificación, sexo</small></th>
                                <th>Sexo</th>
                                <th>Modalidad</th>
                                <th>Prioridad</th>
                                <th>Acciones</th>                                                     
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>       
                </div>
            </div>

            

            <div class="tab-pane fade show" id="tab4" role="tabpanel">
              
                <div class="row">		
                    <div class="form-group col-5 m-0">		
                    </div>	
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="fechainicial4">Fecha Inicial</label>
                        <input type="date" class="form-control  @error('fechainicial4') is-invalid @enderror" value="{{$FechaInicial->format('Y-m-d')}}"  id="fechainicial4" name="fechainicial4"/>
                        @error('fechainicial4')
                            <br>
                            <small>*{{$message}}</small>
                            <br>
                        @enderror
                    </div>
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="fechafinal4">Fecha Final</label>
                        <input type="date"   @error('fechafinal4') class="form-control is-invalid" @enderror
                        class="form-control"  id="fechafinal4" name="fechafinal4"  value="{{$FechaFinal->format('Y-m-d')}}"/>
                        @error('fechafinal4')
                        <br>
                        <small>*{{$message}}</small>
                        <br>
                    @enderror
                    </div>   
                   
                   								                                                    
                    <div class="form-group col-1 m-0">
                        <button type="button" class="btn btn-primary mb-1 btn-sm" data-bs-toggle="modal" data-bs-target="#modalSm">
                            <i class="fa fa-cog"></i> Filtros
                        </button>
                    </div>
                </div>

                <br>
                <div class="row">            
                    <table id="tabletab4" class="table text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id Estudio</th>
                                <th>Fecha Estudio</th> 
                                <th></th>
                                <th><h6>Paciente</h6> <small>Nombre, identificación, sexo</small></th>
                                <th>Sexo</th>
                                <th>Modalidad</th>
                                <th>Prioridad</th>
                                <th>Acciones</th>                                                     
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>       
                </div>
            </div>

        </div>
</div>





<div class="modal fade" id="modalSm">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Opciones</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
    ...
    </div>
    </div>
    </div>
    </div>
    
                                    
@endsection


@push('scripts')
@vite('resources/js/app.js')
<script src="/assets/js/btnEventos.js"></script>

<script src="/assets/js/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.colVis.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.print.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/assets/js/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-lite.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-es-ES.min.js"></script>

<script>

    const institucion = @json($institucion->ruta);


  /********************************************************************************/

  var fechainicial = $("#fechainicial").val();
    fechainicial = fechainicial.replaceAll('-', '');

    var fechafinal = $("#fechafinal").val();
    fechafinal = fechafinal.replaceAll('-', '');
  
    $('#tabletab2').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
      dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax:"{{route('datatable.estudiosportranscribir',['','',''])}}"+"/"+institucion+"/"+fechainicial+"/"+fechafinal,
      order: [[0, 'desc']],
      
      "columnDefs": [
            { "visible": false, "targets": 0 },
            { "visible": false, "targets": 2 },
            { "visible": false, "targets": 4 },
           {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(row.sexo=="*"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:red;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-minus-circle"></i> - Sin Diligenciar</small>';
                    }
                    if(row.sexo=="M"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:green;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-male"></i> - Masculino</small>';
                    }
                    if(row.sexo=="F"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:pink;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-female"></i> - Femenino</small>';
                    }
            },
            "targets": 3
        },
        {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(data=="0"){
                return '<span class="badge bg-info text-white rounded-sm fs-12px fw-500">Baja</span>';
                 }
                 if(data=="1"){
                return '<span class="badge bg-warning text-white rounded-sm fs-12px fw-500">Media</span>';
                 }
                 if(data=="2"){
                return '<span class="badge bg-danger text-white rounded-sm fs-12px fw-500">Alta</span>';
                 }
            },
            "targets": 6
        }
        ],
        columns:[
         {data:'study_pk',orderable:false},
         {data:'fecha',orderable:false},
         {data:'pat_id',orderable:false},
         {data:'nombre',orderable:false},
         {data:'sexo',orderable:false},
         {data:'modalidad',orderable:false},
         {data:'prioridad',orderable:false},
         {data:'action',orderable:false},
          ]
          ,
      info:false,
      buttons: [ {title: 'Estudios', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
      exportOptions: {columns: [1,2,3] }}],
     
    });  
  
  
  
  function actualizador2(){

    var fechainicial = $("#fechainicial").val();
    fechainicial = fechainicial.replaceAll('-', '');
    var fechafinal = $("#fechafinal").val();
    fechafinal = fechafinal.replaceAll('-', '');
  
    const institucion = @json($institucion->ruta);

    $('#tabletab2').DataTable().ajax.url("{{route('datatable.estudiosportranscribir',['','',''])}}"+"/"+institucion+"/"+fechainicial+"/"+fechafinal).load();

  }
  
  $("#fechainicial").change(function () {actualizador2(); });
  $("#fechafinal").change(function () {actualizador2(); });

  /********************************************************************************/
 

  var fechainicial3 = $("#fechainicial3").val();
    fechainicial3 = fechainicial3.replaceAll('-', '');

    var fechafinal3 = $("#fechafinal3").val();
    fechafinal3 = fechafinal3.replaceAll('-', '');


    $('#tabletab3').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
      dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax:"{{route('datatable.estudiosenproceso',['','',''])}}"+"/"+institucion+"/"+fechainicial3+"/"+fechafinal3,
      order: [[0, 'desc']],
      
      "columnDefs": [
            { "visible": false, "targets": 0 },
            { "visible": false, "targets": 2 },
            { "visible": false, "targets": 4 },
           {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(row.sexo=="*"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:red;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-minus-circle"></i> - Sin Diligenciar</small>';
                    }
                    if(row.sexo=="M"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:green;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-male"></i> - Masculino</small>';
                    }
                    if(row.sexo=="F"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:pink;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-female"></i> - Femenino</small>';
                    }
            },
            "targets": 3
        },
        {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(data=="0"){
                return '<span class="badge bg-info text-white rounded-sm fs-12px fw-500">Baja</span>';
                 }
                 if(data=="1"){
                return '<span class="badge bg-warning text-white rounded-sm fs-12px fw-500">Media</span>';
                 }
                 if(data=="2"){
                return '<span class="badge bg-danger text-white rounded-sm fs-12px fw-500">Alta</span>';
                 }
            },
            "targets": 6
        }
        ],
        columns:[
         {data:'study_pk',orderable:false},
         {data:'fecha',orderable:false},
         {data:'pat_id',orderable:false},
         {data:'nombre',orderable:false},
         {data:'sexo',orderable:false},
         {data:'modalidad',orderable:false},
         {data:'prioridad',orderable:false},
         {data:'action',orderable:false},
          ]
          ,
      info:false,
      buttons: [ {title: 'Estudios', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
      exportOptions: {columns: [1,2,3] }}],
     
    });  
  
  
  
  function actualizador3(){

    var fechainicial3 = $("#fechainicial3").val();
    fechainicial3 = fechainicial3.replaceAll('-', '');
    var fechafinal3 = $("#fechafinal3").val();
    fechafinal3 = fechafinal3.replaceAll('-', '');
  
    const institucion = @json($institucion->ruta);

    $('#tabletab3').DataTable().ajax.url("{{route('datatable.estudiosenproceso',['','',''])}}"+"/"+institucion+"/"+fechainicial3+"/"+fechafinal3).load();

  }
  
  $("#fechainicial3").change(function () {actualizador3(); });
  $("#fechafinal3").change(function () {actualizador3(); });


  /********************************************************************************/
 

  var fechainicial4 = $("#fechainicial4").val();
  fechainicial4 = fechainicial4.replaceAll('-', '');

    var fechafinal4 = $("#fechafinal4").val();
    fechafinal4 = fechafinal4.replaceAll('-', '');


    $('#tabletab4').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
      dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax:"{{route('datatable.estudiosporvalidar',['','',''])}}"+"/"+institucion+"/"+fechainicial3+"/"+fechafinal3,
      order: [[0, 'desc']],
      
      "columnDefs": [
            { "visible": false, "targets": 0 },
            { "visible": false, "targets": 2 },
            { "visible": false, "targets": 4 },
           {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(row.sexo=="*"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:red;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-minus-circle"></i> - Sin Diligenciar</small>';
                    }
                    if(row.sexo=="M"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:green;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-male"></i> - Masculino</small>';
                    }
                    if(row.sexo=="F"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:pink;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-female"></i> - Femenino</small>';
                    }
            },
            "targets": 3
        },
        {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(data=="0"){
                return '<span class="badge bg-info text-white rounded-sm fs-12px fw-500">Baja</span>';
                 }
                 if(data=="1"){
                return '<span class="badge bg-warning text-white rounded-sm fs-12px fw-500">Media</span>';
                 }
                 if(data=="2"){
                return '<span class="badge bg-danger text-white rounded-sm fs-12px fw-500">Alta</span>';
                 }
            },
            "targets": 6
        }
        ],
        columns:[
         {data:'study_pk',orderable:false},
         {data:'fecha',orderable:false},
         {data:'pat_id',orderable:false},
         {data:'nombre',orderable:false},
         {data:'sexo',orderable:false},
         {data:'modalidad',orderable:false},
         {data:'prioridad',orderable:false},
         {data:'action',orderable:false},
          ]
          ,
      info:false,
      buttons: [ {title: 'Estudios', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
      exportOptions: {columns: [1,2,3] }}],
     
    });  
  
  
  
  function actualizador4(){

    var fechainicial4 = $("#fechainicial4").val();
    fechainicial4 = fechainicial4.replaceAll('-', '');
    var fechafinal4 = $("#fechafinal4").val();
    fechafinal4 = fechafinal4.replaceAll('-', '');
  
    const institucion = @json($institucion->ruta);

    $('#tabletab4').DataTable().ajax.url("{{route('datatable.estudiosporvalidar',['','',''])}}"+"/"+institucion+"/"+fechainicial4+"/"+fechafinal4).load();

  }
  
  $("#fechainicial4").change(function () {actualizador4(); });
  $("#fechafinal4").change(function () {actualizador4(); });







</script>

<script type="module">

      
 // import Echo from 'laravel-echo';
 // import Echo from 'laravel-echo/dist/echo';
 // import Echo from './path/to/laravel-echo/dist/echo';
/*
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001', // Puerto predeterminado de Laravel Websockets
    auth: {
        headers: {
            'Authorization': 'Bearer ' + Vg0qJd8MYNZn7k0q76N,
        },
    },
});

window.Echo.private('luis')
    .listen('MessageSent', (e) => {
        console.log(e.message);
    });*/
   // App\Events\MessageSent
   console.log("entre");
  Echo.channel('luis')
    .listen('MessageSent',(e) => {

    console.log(e);
    });


</script>

@endpush
