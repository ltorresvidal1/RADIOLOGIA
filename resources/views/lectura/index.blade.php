@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/summernote/css/summernote-lite.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" rel="stylesheet" />

       <style>



.wrapper{
  user-select: none;
  width: 100%;
}
.wrapper .time{
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  padding: 0 10px;
}
.wrapper .time span{
  width: 30px;
  text-align: center;
  font-size: 16px;
  font-weight: 500;
  color: #ffffff;
}
.time span.colon{
  width: 10px;
}
.time span.ms-colon,
.time span.millisecond{
  color: #e82a2a;
}
.wrapper .buttons{
  text-align: center;
  margin-top: 20px;
}
.buttons button{
  padding: 6px 16px;
  outline: none;
  border: none;
  margin: 0 5px;
  color: #ffffff;
  font-size: 12px;
  font-weight: 500;
  border-radius: 4px;
  cursor: pointer;
  box-shadow: 10px 10px 20px rgba(0,0,0,0.09);
}
.buttons button.active,
.buttons button.stopActive{
  pointer-events: none;
  color: #FEC35E;
}

/*
    .music_player{
    position:relative;
    margin: 0 auto;
    height:1rem;
    width:21rem;
    }


    .controllers{
      background:#29374f;
      height:2.5rem;
      width:21.4rem;
      position:absolute;
      right:0;
      bottom:0;
      font-family:FontAwesome;
      text-align:center;
      color:#ffffff;
    }
    .controllers i{
        position:relative;
        bottom:-0.7rem;
        padding:0 15px 0 15px;
      }
    
      .controllers i{
    cursor :pointer;
    }
 

    #btnLeft:focus {
    color:#FEC35E;
    }

    */
       </style>
@endpush



@extends('layouts.plantillaLectura')
@section('title','RADIOLOGIA')


@section('content')

<div id="content" class="app-content p-0">
  <!-- BEGIN mailbox -->
  <div class="mailbox">
      <!-- BEGIN mailbox-toolbar -->

 
      <div class="mailbox-toolbar">
          <div class="mailbox-toolbar-item"><span class="mailbox-toolbar-text">Opciones de Lectura</span></div>
          <ul class="nav nav-pills mb-3" role="tablist">
              <li class="mailbox-toolbar-item" id='BtnAddLecturas' role="presentation"><a id="m1" href="#AddLectura" class="mailbox-toolbar-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Agregar Lecturas</a></li>
              <li class="mailbox-toolbar-item" id='BtnAdmLecturas' role="presentation"><a id="m2" href="#VerLecturas" class="mailbox-toolbar-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Lecturas Creadas</a></li>
              <li class="mailbox-toolbar-item" id='BtnEditLecturas' role="presentation"  style="display:none"><a id="m3" href="#EditLectura" class="mailbox-toolbar-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Editar Lecturas</a></li>
               
            </ul>
         
      </div>
      <!-- END mailbox-toolbar -->
      <!-- BEGIN mailbox-body -->

<div class="tab-content">
      <div class="tab-pane fade active show" id="AddLectura" role="tabpanel">

      <div class="mailbox-body">
          <!-- BEGIN mailbox-sidebar -->
          <div class="mailbox-sidebar d-none d-lg-block">
              <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                 
                  <div class="mailbox-list">

                  
                      <div class="desktop-sticky-top d-none d-lg-block">
                          <div class="card mb-3">
                          <div class="list-group list-group-flush">
                          <div class="list-group-item fw-600 px-3 d-flex rounded-0">
                          <span class="flex-fill">Datos del Paciente</span>
                          </div>
                          <div class="list-group-item px-3">
                      
                          <div class="fw-600">Nombre: {{$datospaciente->nombrepaciente}}</div>
                          <div class="fw-600">Documento: {{$datospaciente->documento}}</div>
                          <div class="fw-600">Edad: {{$datospaciente->edad_a}} Años {{$datospaciente->edad_m}} Meses {{$datospaciente->edad_d}} Días </div>
                          <div class="fw-600">Sexo: {{$datospaciente->sexo}}</div>
                        
                          </div>
                    
                          

                          <div class="list-group-item px-3">
                          <div class="text-decoration"><small><strong>Visor Web</strong></small></div>
                                                     
                          <div class="d-flex align-items-center mb-3">
                              <a href="#"><img src="/assets/img/usuarios/logo.jpg" alt="" width="50" class="rounded-circle"></a>
                             
                              <div class="flex-fill ps-2">
                              <div class="fw-600"><a href="#" class="text-decoration-none">Ver Estudio</a></div>
                              <input type="hidden" class="form-control" id="codigo_Estudio" autocomplete="off" value="{{$idestudio}}">
                              <div class="text-decoration-600 fs-13px">04/10/2022</div>
                              </div>
                              </div>
                        
                          </div>
                          

                          <div class="list-group-item px-3">
                            <div class="text-decoration"><small><strong>Grabador</strong></small></div>
                                       <br>                 
                                 <div class="d-flex align-items-center mb-3">
                                    <div class="wrapper">
                                        <div class="time">
                                          <span class="hour">00</span>
                                          <span class="colon">:</span>
                                          <span class="minute">00</span>
                                          <span class="colon">:</span>
                                          <span class="second">00</span>
                                          <span class="colon ms-colon">:</span>
                                          <span class="millisecond">00</span>
                                        </div>
                                        <div class="buttons">
                                          <button class="start" id="record" title="Grabar"><i class="fa fa-play" aria-hidden="true" ></i></button>
                                          <button class="stop"  id="pause" title="Pausar"><i class="fa fa-pause" aria-hidden="true"></i></button>
                                          <button class="reset" id="stop" title="Detener"><i class="fa fa-stop" aria-hidden="true" ></i></button>
                                          <button class="save" id="subir_servidor" title="Guardar"><i class="fa fa-save" aria-hidden="true" ></i></button>
                                        </div>
                                      </div>
                               <!--     <div class="music_player">
                                    
                                        <div class="controllers">
                                       
                                            <a id="btnLeft"> <i class="fa fa-play" aria-hidden="true" title="Grabar / Pausar"></i> </a>
                                            <a> <i class="fa fa-redo" aria-hidden="true" id="reanudar" title="Continuar"></i> </a>
                                            <a> <i class="fa fa-stop" aria-hidden="true" title="Detener"></i> </a>
                                            <a> <i class="fa fa-save" aria-hidden="true" title="Guardar"></i> </a>
                                        </div>
                                    </div> 

                                -->
                                </div>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="autoplay" checked="">
                                    <label class="form-check-label" for="customSwitch1">Auto Reproducir</label>
                                </div>
                                <br>
                                   <fieldset id="previewField" class="">
                            
                                <audio id="preview" class="audio-player" controls="" style="width: 100%"></audio> 

                                   
                                </fieldset> 

                                
                            </div>
                          </div>
                          </div>
                          </div>
           


                  </div>
              </div>
          </div>
          <!-- END mailbox-sidebar -->
          <!-- BEGIN mailbox-content -->
          <div class="mailbox-content">
              <!-- BEGIN scrollbar -->
              <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                  <!-- BEGIN mailbox-detail -->
                  <div class="mailbox-detail">                           
                      
                      <!-- BEGIN mailbox-detail-content -->
                       <div class="mailbox-detail-content">
                              <form id="AddForm" action="{{route('lectura.store')}}" method="POST">
                                  @csrf
                      
                                  <div class="row">	
          
                                      <div class="col-md-8">
                                        <input type="hidden" id="idestudio" name="idestudio" value="{{$idestudio}}">
                                      <div class="row mb-2">
                                          <label class="col-form-label w-80px px-2 fw-500">Estudio :</label>
                                          <div class="col">
                                              <input type="text"   @error('estudio') class="form-control is-invalid"  
                                              @enderror
                                              class="form-control"  id="estudio" name="estudio"  value="{{old('estudio')}}"/>
                                              @error('estudio')
                                              <br>
                                              <small>*{{$message}}</small>
                                              <br>
                                          @enderror	
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="row mb-2">
                                          <label class="col-form-label w-70px px-2 fw-500">Fecha :</label>
                                          <div class="col">
                                              <input type="date" class="form-control  @error('fechaestudio') is-invalid @enderror"  id="fechaestudio" name="fechaestudio" value="{{old('fechaestudio',$FechaActual->format('Y-m-d'))}}" />
                                                                      @error('fechaestudio')
                                                                          <br>
                                                                          <small>*{{$message}}</small>
                                                                          <br>
                                                                      @enderror
                                          </div>
                                      </div>
                                  </div>
                                  </div>
                                  <div class="row">			
                                  <textarea name="informe" id='informe' class="summernote form-control  @error('informe') is-invalid @enderror" >{{old('informe')}}</textarea> 
                                  @error('informe')
                                                                          <br>
                                                                          <small>*{{$message}}</small>
                                                                          <br>
                                                                      @enderror
                                  </div>
                                  <br>
                              
                                      <div class='text-right'>
                                      <button type="submit" id="boton_ok" class="btn btn-primary">Aceptar</button>
                                      </div>
                  
                              </form>
                      </div>
                      
                                    

                          
                          <!-- END mailbox-detail-body -->
                      </div>
                      <!-- END mailbox-detail-content -->
                  </div>
                  <!-- END mailbox-detail -->
              </div>
              <!-- END scrollbar -->
          </div>
          <!-- END mailbox-content -->
      </div>
     

      <div class="tab-pane fade" id="VerLecturas" role="tabpanel">

      <!--  
        <div class="row p-4">    
        <table id="datatableLecturas" class="table text-nowrap w-100">
            <thead>
                <tr>
                    <th>IdLectura</th>
                    <th>Estudio</th>
                    <th>Informe</th>  
                    <th>Informe_html</th>              
                    <th>Fecha</th>
                    <th>Acciones</th>                                                    
                </tr>
            </thead>
            <tbody>
                @foreach ($lecturas as $lectura)
                <tr>
                    <td>{{$lectura->id}}</td>
                    <td>{{$lectura->estudio}}</td>
                    <td>{{$lectura->informe}}</td>
                    <td>{{$lectura->informe}}</td>
                    <td>{{$lectura->fechaestudio}} </td>
                    <td>
        
                        <div class="dropdown text-center">
                            <a href="#" data-bs-toggle="dropdown" class="text-dark text-decoration-none"><i class="fa fa-ellipsis-v fa-fw fa-lg"></i> </a>
                            <div class="dropdown-menu">
                                <a onclick="EditarLectura()" class="dropdown-item"><i class="far fa-edit fa-fw fa-lg"></i> Editar</a>
                                <form id="delete-{{$lectura->id}}" action="{{route('lectura.destroy',$lectura)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="#" class="dropdown-item"  onclick="EliminarLectura2({{ $lectura->id }})"><i class="far fa-trash-alt fa-fw fa-lg"></i> Eliminar</a>
                            </div>
                        </div>
        
               
                    </td>
                 </tr>
                
                @endforeach
              
            
            </tbody>
        </table>       
    </div> 
     -->
        <div class="row p-4">    
            <div class="table-responsive">
                <table id="datatableLecturas"  class="table table-hover">
                    <thead>
                        <tr>
                            <th>IdLectura</th>
                            <th>Estudio</th>
                            <th>Informe</th>  
                            <th>Informe_html</th>              
                            <th>Fecha</th>
                            <th>Acciones</th>                                                     
                        </tr>
                    </thead>
                    <tbody>
        
                    </tbody>
                </table>   
            </div> 
        </div>
                    
   
      </div> 
   
      <div class="tab-pane fade" id="EditLectura" role="tabpanel">
<!---
        <div class="row p-4">            
            <form id="EditForm" method="POST">
                @csrf
                            
                <div class="row">	

                    <div class="col-md-8">
                      <input type="hidden" id="idestudio2" name="idestudio2" value="{{old('idestudio2')}}">
                    <div class="row mb-2">
                        <label class="col-form-label w-80px px-2 fw-500">Estudio :</label>
                        <div class="col">
                            <input type="text"   class="form-control @error('estudio2') is-invalid  @enderror"
                            class="form-control"  id="estudio2" name="estudio2"  value="{{old('estudio2')}}"/>
                            @error('estudio2')
                            <br>
                            <small>*{{$message}}</small>
                            <br>
                        @enderror	
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row mb-2">
                        <label class="col-form-label w-70px px-2 fw-500">Fecha :</label>
                        <div class="col">
                            <input type="date" class="form-control  @error('fechaestudio2') is-invalid @enderror"  id="fechaestudio2" name="fechaestudio2" value="{{old('fechaestudio2')}}" />
                                                    @error('fechaestudio2')
                                                        <br>
                                                        <small>*{{$message}}</small>
                                                        <br>
                                                    @enderror
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">			
                <textarea name="informe2" id='informe2' class="summernote2 form-control  @error('informe2') is-invalid @enderror" >{{old('informe2')}}</textarea> 
                @error('informe2')
                                                        <br>
                                                        <small>*{{$message}}</small>
                                                        <br>
                                                    @enderror
                </div>
                <br>
            
                    <div class='text-right'>
                    <button   type="button" id="boton_ok2" class="btn btn-primary">Aceptar</button>
                    </div>
            </form>

        </div>

        --->
                
        
        <div class="row p-4">            
            <form id="EditForm" >
                @csrf
  
                <div class="row">	
                    <div class="alert alert-danger" style="display:none" onerror="(function(el){ setTimeout(function(){ $(el).parent().remove(); },500 ); })(this);"></div>
                    <div class="col-md-8">
                
                      <input type="hidden" id="idestudio2" name="idestudio2" value="{{old('idestudio2')}}">
                    
                    <div class="row mb-2">
                        <label class="col-form-label w-80px px-2 fw-500">Estudio :</label>
                        <div class="col">
                            <input type="text"   class="form-control"
                            class="form-control"  id="estudio2" name="estudio2"  value="{{old('estudio2')}}"/>
                            <small id="error_estudio2"  style="display:none" >*El campo estudio es obligatorio.</small>  
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row mb-2">
                        <label class="col-form-label w-70px px-2 fw-500">Fecha :</label>
                        <div class="col">
                            <input type="date" class="form-control"  id="fechaestudio2" name="fechaestudio2" value="{{old('fechaestudio2')}}" />
                            <small id="error_fechaestudio2"  style="display:none">*El campo fecha estudio es obligatorio.</small>                       
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">			
                <textarea name="informe2" id='informe2' class="summernote2 form-control">{{old('informe2')}}</textarea> 
                <small id="error_informe2"  style="display:none" >*El campo informe es obligatorio.</small>



                </div>
                <br>
            
                    <div class='text-right'>
                    <button   type="button" id="boton_ok2" class="btn btn-primary">Aceptar</button>
                    </div>
            </form>

        </div>
            
      </div> 

    </div>
  </div>
      <!-- END mailbox-body -->
  </div>
  <!-- END mailbox -->
</div>


@endsection

@push('scripts')

<script src="/assets/js/btnEventos.js"></script>
<script src="/assets/js/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.select.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.colVis.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.print.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/assets/js/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-lite.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-es-ES.min.js"></script>

<script>


$(document).ready(function () {

let hr = min = sec = ms = "0" + 0,
  startTimer;

const startBtn = document.querySelector(".start"),
 stopBtn = document.querySelector(".stop"),
 resetBtn = document.querySelector(".reset");
 saveBtn = document.querySelector(".save");

 


function putValue() {
  document.querySelector(".millisecond").innerText = ms;
  document.querySelector(".second").innerText = sec;
  document.querySelector(".minute").innerText = min;
  document.querySelector(".hour").innerText = hr;
}
var numSentences = 1;

function getRandomInt(max) {
    min = 1;
    max++;
    return Math.floor(Math.random() * (max - min)) + min; 
}

function randomString() {
    return Math.random().toString(36).substring(5);
}

$("#codigo_Estudio").val();

if (navigator.mediaDevices) {
    var constraints = { audio: true };
    var chunks = [];
    var blob = null;
    var clipName = "";

    navigator.mediaDevices.getUserMedia(constraints)
        .then(function (stream) {

            var mediaRecorder = new MediaRecorder(stream);
            var estadorec=0;
            $("#record").click(function () {
                estadorec=estadorec+1;
             
                if(estadorec==1){
                $("#preview").trigger("stop");
                chunks = [];
                mediaRecorder.start();
                $("#record").attr("disabled", true);
                $("#pause").attr("disabled", false);
                $("#stop").attr("disabled", false);
                $("#subir_servidor").attr("disabled", true);


           


              } 
               if(estadorec>=2){
                mediaRecorder.resume();
              }

              startBtn.classList.add("active");
                stopBtn.classList.remove("stopActive");

                startTimer = setInterval(()=>{
                    ms++
                    ms = ms < 10 ? "0" + ms : ms;

                    if(ms == 100){
                    sec++;
                    sec = sec < 10 ? "0" + sec : sec;
                    ms = "0" + 0;
                    }
                    if(sec == 60){
                    min++;
                    min = min < 10 ? "0" + min : min;
                    sec = "0" + 0;
                    }
                    if(min == 60){
                    hr++;
                    hr = hr < 10 ? "0" + hr : hr;
                    min = "0" + 0;
                    }

                    putValue();
                },10); 
            
            });


            $("#pause").click(function () {
              mediaRecorder.pause();
              $("#record").attr("disabled", false);
                startBtn.classList.remove("active");
                stopBtn.classList.add("stopActive");
                clearInterval(startTimer);
            });
     
            
            
            $("#stop").click(function () {
                mediaRecorder.stop();
                $("#record").attr("disabled", false);
                $("#pause").attr("disabled", true);
                $("#reanudar").attr("disabled", true);
                $("#stop").attr("disabled", true);
                $("#subir_servidor").attr("disabled", false);
                
                startBtn.classList.remove("active");
                stopBtn.classList.remove("stopActive");
                clearInterval(startTimer);
                hr = min = sec = ms = "0" + 0;
                putValue();
                estadorec=0;
            });

            $("#subir_servidor").click(function () {
                var xhr = new XMLHttpRequest();
                xhr.onload = function (e) {
                    if (this.readyState === 4) {
                        console.log("Server returned: ", e.target.responseText);
                    }
                };
                var fd = new FormData();
              
                fd.append("name", $('#codigo_Estudio').val());
                fd.append("audio", blob, clipName);
                xhr.open("POST", "../upload.php", false);
                xhr.send(fd);
                if (xhr.responseText == "\nok") {
                    $('#sentenceNumber').val(getRandomInt(numSentences));
                    $("#record").attr("disabled", false);
                    $("#stop").attr("disabled", true);
                    $("#subir_servidor").attr("disabled", true);
                   
                    startBtn.classList.remove("active");
                    stopBtn.classList.remove("stopActive");
                    clearInterval(startTimer);
                    hr = min = sec = ms = "0" + 0;
                    putValue();
                }
                else {
                    alert('error during upload');
                }
            });

            mediaRecorder.onstop = function (e) {

                clipName = $("#dataset").val() + "_" + $("#sentenceNumber").val();

                blob = new Blob(chunks, { 'type': 'audio/ogg; codecs=opus' });
                chunks = [];
                var audioURL = URL.createObjectURL(blob);
                $("#preview").attr("src", audioURL);

                if ($("#autoplay").is(":checked"))
                    $("#preview").trigger("play");
            }

            mediaRecorder.ondataavailable = function (e) {
                chunks.push(e.data);
            }
        })
        .catch(function (err) {
            alert('The following error occurred: ' + err);
        })
}

});
</script>



<script>

 $( "#BtnAddLecturas" ).bind( "click", function() {
        document.getElementById("BtnEditLecturas").setAttribute("style","display:none");
     
    });

 $( "#BtnAdmLecturas" ).bind( "click", function() {
        document.getElementById("BtnEditLecturas").setAttribute("style","display:none");
     
    });



function EditarLectura(){

        document.getElementById("AddLectura").setAttribute("class","tab-pane fade");
        document.getElementById("m1").setAttribute("class","mailbox-toolbar-link");
        document.getElementById("m1").setAttribute("aria-selected","false");

        document.getElementById("VerLecturas").setAttribute("class","tab-pane fade");
        document.getElementById("m2").setAttribute("class","mailbox-toolbar-link");
        document.getElementById("m2").setAttribute("aria-selected","false");


        document.getElementById("BtnEditLecturas").removeAttribute("style");
        document.getElementById("EditLectura").setAttribute("class","tab-pane fade active show");
        document.getElementById("m3").setAttribute("aria-selected","true");
        document.getElementById("m3").setAttribute("class","mailbox-toolbar-link active");
     
}


 var handleRenderSummernote1 = function() {

    var totalHeight = ($(window).height() /2)-70;

    $('#informe').summernote({
        lang: 'es-ES' ,
		height: totalHeight,
        disableDragAndDrop: true,           
        placeholder:"Digite la lectura para este estudio",
        toolbar: [
            ['font', ['bold', 'italic',  'underline', 'clear']],
            ['para', ['ul', 'ol','paragraph']],
            ['view', ['fullscreen']],
        ],
        callbacks: {
        onPaste: function (e) {
        
        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        e.preventDefault();
        document.execCommand('insertText', false, bufferText);
    }
}
	});

    $('#informe2').summernote({
        lang: 'es-ES' ,
		height: totalHeight,
        disableDragAndDrop: true,           
        placeholder:"Digite la lectura para este estudio",
        toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol','paragraph']],
            ['view', ['fullscreen']],
        ]
	});


    

};



$(document).ready(function() {
	handleRenderSummernote1();
});


////////con ajax
var idestudio = $("#idestudio").val();
const institucion = @json($institucion->ruta);



datatableLecturas=$('#datatableLecturas').DataTable({
  
  dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
  responsive: true,
  paging:false,
  autoWidth: false,
  ajax:"{{route('datatable.lecturasestudiosclientes',['',''])}}"+"/"+institucion+"/"+idestudio,
  order: [[0, 'desc']],
  select:true,
  "columnDefs": [
    { "visible": false, "targets": 0 },
    { "visible": false, "targets": 3 }
  ],
  columns:[
  
     {data:'lecturas_id'},
     {"width": "20%",  data:'estudio',orderable:false},
     {"width": "60%",  data:'informe',orderable:false},
     {data:'informe_html'},
     {"width": "10%",  data:'fechaestudio',orderable:false},
     {"width": "10%",  data:'action',orderable:false},
      ], 
  info:false,
  buttons: [ {title: 'Lecturas', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
  exportOptions: {columns: [1,2,3] }}],
  "language": {
"processing": "Procesando...",
"lengthMenu": "Mostrar _MENU_ registros",
"zeroRecords": "No se encontraron resultados",
"emptyTable": "Ningún dato disponible en esta tabla",
"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
"infoFiltered": "(filtrado de un total de _MAX_ registros)",
"search": "Buscar:",
"infoThousands": ",",
"loadingRecords": "Cargando...",
"paginate": {
    "first": "Primero",
    "last": "Último",
    "next": "Siguiente",
    "previous": "Anterior"
},
"aria": {
    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
    "sortDescending": ": Activar para ordenar la columna de manera descendente"
},
"buttons": {
    "copy": "Copiar",
    "colvis": "Visibilidad",
    "collection": "Colección",
    "colvisRestore": "Restaurar visibilidad",
    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
    "copySuccess": {
        "1": "Copiada 1 fila al portapapeles",
        "_": "Copiadas %ds fila al portapapeles"
    },
    "copyTitle": "Copiar al portapapeles",
    "csv": "CSV",
    "excel": "Excel",
    "pageLength": {
        "-1": "Mostrar todas las filas",
        "_": "Mostrar %d filas"
    },
    "pdf": "PDF",
    "print": "Imprimir",
    "renameState": "Cambiar nombre",
    "updateState": "Actualizar",
    "createState": "Crear Estado",
    "removeAllStates": "Remover Estados",
    "removeState": "Remover",
    "savedStates": "Estados Guardados",
    "stateRestore": "Estado %d"
},
"autoFill": {
    "cancel": "Cancelar",
    "fill": "Rellene todas las celdas con <i>%d<\/i>",
    "fillHorizontal": "Rellenar celdas horizontalmente",
    "fillVertical": "Rellenar celdas verticalmentemente"
},
"decimal": ",",
"searchBuilder": {
    "add": "Añadir condición",
    "button": {
        "0": "Constructor de búsqueda",
        "_": "Constructor de búsqueda (%d)"
    },
    "clearAll": "Borrar todo",
    "condition": "Condición",
    "conditions": {
        "date": {
            "after": "Despues",
            "before": "Antes",
            "between": "Entre",
            "empty": "Vacío",
            "equals": "Igual a",
            "notBetween": "No entre",
            "notEmpty": "No Vacio",
            "not": "Diferente de"
        },
        "number": {
            "between": "Entre",
            "empty": "Vacio",
            "equals": "Igual a",
            "gt": "Mayor a",
            "gte": "Mayor o igual a",
            "lt": "Menor que",
            "lte": "Menor o igual que",
            "notBetween": "No entre",
            "notEmpty": "No vacío",
            "not": "Diferente de"
        },
        "string": {
            "contains": "Contiene",
            "empty": "Vacío",
            "endsWith": "Termina en",
            "equals": "Igual a",
            "notEmpty": "No Vacio",
            "startsWith": "Empieza con",
            "not": "Diferente de",
            "notContains": "No Contiene",
            "notStartsWith": "No empieza con",
            "notEndsWith": "No termina con"
        },
        "array": {
            "not": "Diferente de",
            "equals": "Igual",
            "empty": "Vacío",
            "contains": "Contiene",
            "notEmpty": "No Vacío",
            "without": "Sin"
        }
    },
    "data": "Data",
    "deleteTitle": "Eliminar regla de filtrado",
    "leftTitle": "Criterios anulados",
    "logicAnd": "Y",
    "logicOr": "O",
    "rightTitle": "Criterios de sangría",
    "title": {
        "0": "Constructor de búsqueda",
        "_": "Constructor de búsqueda (%d)"
    },
    "value": "Valor"
},
"searchPanes": {
    "clearMessage": "Borrar todo",
    "collapse": {
        "0": "Paneles de búsqueda",
        "_": "Paneles de búsqueda (%d)"
    },
    "count": "{total}",
    "countFiltered": "{shown} ({total})",
    "emptyPanes": "Sin paneles de búsqueda",
    "loadMessage": "Cargando paneles de búsqueda",
    "title": "Filtros Activos - %d",
    "showMessage": "Mostrar Todo",
    "collapseMessage": "Colapsar Todo"
},
"select": {
    "cells": {
        "1": "1 celda seleccionada",
        "_": "%d celdas seleccionadas"
    },
    "columns": {
        "1": "1 columna seleccionada",
        "_": "%d columnas seleccionadas"
    },
    "rows": {
        "1": "1 fila seleccionada",
        "_": "%d filas seleccionadas"
    }
},
"thousands": ".",
"datetime": {
    "previous": "Anterior",
    "next": "Proximo",
    "hours": "Horas",
    "minutes": "Minutos",
    "seconds": "Segundos",
    "unknown": "-",
    "amPm": [
        "AM",
        "PM"
    ],
    "months": {
        "0": "Enero",
        "1": "Febrero",
        "10": "Noviembre",
        "11": "Diciembre",
        "2": "Marzo",
        "3": "Abril",
        "4": "Mayo",
        "5": "Junio",
        "6": "Julio",
        "7": "Agosto",
        "8": "Septiembre",
        "9": "Octubre"
    },
    "weekdays": [
        "Dom",
        "Lun",
        "Mar",
        "Mie",
        "Jue",
        "Vie",
        "Sab"
    ]
},
"editor": {
    "close": "Cerrar",
    "create": {
        "button": "Nuevo",
        "title": "Crear Nuevo Registro",
        "submit": "Crear"
    },
    "edit": {
        "button": "Editar",
        "title": "Editar Registro",
        "submit": "Actualizar"
    },
    "remove": {
        "button": "Eliminar",
        "title": "Eliminar Registro",
        "submit": "Eliminar",
        "confirm": {
            "_": "¿Está seguro que desea eliminar %d filas?",
            "1": "¿Está seguro que desea eliminar 1 fila?"
        }
    },
    "error": {
        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
    },
    "multi": {
        "title": "Múltiples Valores",
        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
        "restore": "Deshacer Cambios",
        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
    }
},
"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
"stateRestore": {
    "creationModal": {
        "button": "Crear",
        "name": "Nombre:",
        "order": "Clasificación",
        "paging": "Paginación",
        "search": "Busqueda",
        "select": "Seleccionar",
        "columns": {
            "search": "Búsqueda de Columna",
            "visible": "Visibilidad de Columna"
        },
        "title": "Crear Nuevo Estado",
        "toggleLabel": "Incluir:"
    },
    "emptyError": "El nombre no puede estar vacio",
    "removeConfirm": "¿Seguro que quiere eliminar este %s?",
    "removeError": "Error al eliminar el registro",
    "removeJoiner": "y",
    "removeSubmit": "Eliminar",
    "renameButton": "Cambiar Nombre",
    "renameLabel": "Nuevo nombre para %s",
    "duplicateError": "Ya existe un Estado con este nombre.",
    "emptyStates": "No hay Estados guardados",
    "removeTitle": "Remover Estado",
    "renameTitle": "Cambiar Nombre Estado"
}
} 
});  


datatableLecturas.on('select', function (e, dt, type, indexes) {
  
        if ( type === 'row' ) {
          
            document.getElementById("idestudio2").value = datatableLecturas.rows(indexes).data().pluck('lecturas_id').toArray();
            document.getElementById("estudio2").value =datatableLecturas.rows(indexes).data().pluck('estudio').toArray();
            document.getElementById("fechaestudio2").value = datatableLecturas.rows(indexes).data().pluck('fechaestudio').toArray();
            var  informe_html= datatableLecturas.rows(indexes).data().pluck('informe_html').toArray();

            $('#informe2').summernote('reset');
            $('#informe2').summernote('pasteHTML', ConvetidorHtml(informe_html));
  
           }
         
  
    });


    function ConvetidorHtml(html){
        var tempDivElement = document.createElement("div");
        tempDivElement.innerHTML = html;
        return tempDivElement.textContent || tempDivElement.innerText || "";
    }


    
    $("#boton_ok2").on("click",function(e){
        e.preventDefault();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        let idestudio=$("#idestudio2").val();
        let estudio=$("#estudio2").val();
        let informe=$("#informe2").val();
        let fechaestudio=$("#fechaestudio2").val();
        let _token= $("input[name=_token]").val();
     
       $.ajax(
                    {
                        url: "{{route('lectura.update')}}",
                        type: "GET",
                        data: {

                            idestudio2:idestudio,
                            estudio2:estudio,
                            informe2:informe,
                            fechaestudio2:fechaestudio,
                            _token :_token,
                      
                        },
                        success: function (data){         
                            document.getElementById("estudio2").setAttribute("class","form-control");
                            document.getElementById("fechaestudio2").setAttribute("class","form-control");
                            document.getElementById("error_estudio2").setAttribute("style","display:none");
                            document.getElementById("error_fechaestudio2").setAttribute("style","display:none");
                            document.getElementById("error_informe2").setAttribute("style","display:none");

                            jQuery.each(data.errors, function(key, value){
                          console.log(data);
                            if(value=="El campo estudio2 es obligatorio."){
                                
                                document.getElementById("error_estudio2").removeAttribute("style");
                                document.getElementById("estudio2").setAttribute("class","form-control is-invalid");}
                            if(value=="El campo fechaestudio2 es obligatorio."){
                                
                                document.getElementById("error_fechaestudio2").removeAttribute("style");
                                document.getElementById("fechaestudio2").setAttribute("class","form-control is-invalid");}
                            if(value=="El campo informe2 es obligatorio."){
                                document.getElementById("error_informe2").removeAttribute("style");
                            }
                  	//		jQuery('.alert-danger').show();
                  	//		jQuery('.alert-danger').append('<p>'+value+'</p>');
                  	        	});
                            datatableLecturas.ajax.reload(null,false);
                          
                        }
                    });


 });










          //document.getElementById("idestudio2").value = Tabla_Htm_EstudiosPorSerie.row(row).data().idlectura;
          //document.getElementById("estudio2").value = datatableLecturas.row(row).data().estudio;
         // document.getElementById("fechaestudio2").value = Tabla_Htm_EstudiosPorSerie.row(row).data().fechaestudio;
          //document.getElementById("informe2").value = Tabla_Htm_EstudiosPorSerie.row(row).data().informe;


/*
    $("#EditForm").submit(function(e){
        e.preventDefault();
        alert("yes");
    });
*/
    /*
          for (var i=0; i < informe_html.length; i++) {
            informe_html[i] = informe_html[i].toString()
                        .replace(/&gt;/g, '>')
                        .replace(/&lt;/g, '<')
                        .replace(/&amp;/g, '&')
                        .replace(/&quot;/g, '"')
                        .replace(/&#163;/g, '£')
                        .replace(/&#39;/g, '\'')
                        .replace(/&#10;/g, '\n');
        }
       

        */
    
        //$("#boton_ok2").on("click",function(){
        //    event.preventDefault();
       //    alert("mejorando");
       //function sendForm() {
     //   event.preventDefault();
      //  const idlectura= document.getElementById("idestudio2").value;
      //  ActualizarLectura(idlectura);
      
 /*  var valido = false; //DEBERIAS REALIZAR LAS VALIDACIONES

  if (valido) {
    document.getElementById("EditForm").submit();
  } else {
    alert("VALIDA LOS CAMPOS");
    return false;
  }
  
  
  
  
  
  


/*** sin ajax
datatableLecturas=$('#datatableLecturas').DataTable({
  
  dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
  responsive: true,
  paging:false,
  autoWidth: false,
  order: [[0, 'desc']],
  select:true,
  "columnDefs": [
    { "visible": false, "targets": 0 },
    { "visible": false, "targets": 3 }
  ], columns: [
        { name: 'lecturas_id' },
        { name: 'estudio' },
        { name: 'position' },
        { name: 'informe_html' },
        { name: 'fechaestudio' },
        { name: 'action' },
    ],
  info:false,
  buttons: [ {title: 'Lecturas', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
  exportOptions: {columns: [1,2,3] }}],
  "language": {
"processing": "Procesando...",
"lengthMenu": "Mostrar _MENU_ registros",
"zeroRecords": "No se encontraron resultados",
"emptyTable": "Ningún dato disponible en esta tabla",
"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
"infoFiltered": "(filtrado de un total de _MAX_ registros)",
"search": "Buscar:",
"infoThousands": ",",
"loadingRecords": "Cargando...",
"paginate": {
    "first": "Primero",
    "last": "Último",
    "next": "Siguiente",
    "previous": "Anterior"
},
"aria": {
    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
    "sortDescending": ": Activar para ordenar la columna de manera descendente"
},
"buttons": {
    "copy": "Copiar",
    "colvis": "Visibilidad",
    "collection": "Colección",
    "colvisRestore": "Restaurar visibilidad",
    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
    "copySuccess": {
        "1": "Copiada 1 fila al portapapeles",
        "_": "Copiadas %ds fila al portapapeles"
    },
    "copyTitle": "Copiar al portapapeles",
    "csv": "CSV",
    "excel": "Excel",
    "pageLength": {
        "-1": "Mostrar todas las filas",
        "_": "Mostrar %d filas"
    },
    "pdf": "PDF",
    "print": "Imprimir",
    "renameState": "Cambiar nombre",
    "updateState": "Actualizar",
    "createState": "Crear Estado",
    "removeAllStates": "Remover Estados",
    "removeState": "Remover",
    "savedStates": "Estados Guardados",
    "stateRestore": "Estado %d"
},
"autoFill": {
    "cancel": "Cancelar",
    "fill": "Rellene todas las celdas con <i>%d<\/i>",
    "fillHorizontal": "Rellenar celdas horizontalmente",
    "fillVertical": "Rellenar celdas verticalmentemente"
},
"decimal": ",",
"searchBuilder": {
    "add": "Añadir condición",
    "button": {
        "0": "Constructor de búsqueda",
        "_": "Constructor de búsqueda (%d)"
    },
    "clearAll": "Borrar todo",
    "condition": "Condición",
    "conditions": {
        "date": {
            "after": "Despues",
            "before": "Antes",
            "between": "Entre",
            "empty": "Vacío",
            "equals": "Igual a",
            "notBetween": "No entre",
            "notEmpty": "No Vacio",
            "not": "Diferente de"
        },
        "number": {
            "between": "Entre",
            "empty": "Vacio",
            "equals": "Igual a",
            "gt": "Mayor a",
            "gte": "Mayor o igual a",
            "lt": "Menor que",
            "lte": "Menor o igual que",
            "notBetween": "No entre",
            "notEmpty": "No vacío",
            "not": "Diferente de"
        },
        "string": {
            "contains": "Contiene",
            "empty": "Vacío",
            "endsWith": "Termina en",
            "equals": "Igual a",
            "notEmpty": "No Vacio",
            "startsWith": "Empieza con",
            "not": "Diferente de",
            "notContains": "No Contiene",
            "notStartsWith": "No empieza con",
            "notEndsWith": "No termina con"
        },
        "array": {
            "not": "Diferente de",
            "equals": "Igual",
            "empty": "Vacío",
            "contains": "Contiene",
            "notEmpty": "No Vacío",
            "without": "Sin"
        }
    },
    "data": "Data",
    "deleteTitle": "Eliminar regla de filtrado",
    "leftTitle": "Criterios anulados",
    "logicAnd": "Y",
    "logicOr": "O",
    "rightTitle": "Criterios de sangría",
    "title": {
        "0": "Constructor de búsqueda",
        "_": "Constructor de búsqueda (%d)"
    },
    "value": "Valor"
},
"searchPanes": {
    "clearMessage": "Borrar todo",
    "collapse": {
        "0": "Paneles de búsqueda",
        "_": "Paneles de búsqueda (%d)"
    },
    "count": "{total}",
    "countFiltered": "{shown} ({total})",
    "emptyPanes": "Sin paneles de búsqueda",
    "loadMessage": "Cargando paneles de búsqueda",
    "title": "Filtros Activos - %d",
    "showMessage": "Mostrar Todo",
    "collapseMessage": "Colapsar Todo"
},
"select": {
    "cells": {
        "1": "1 celda seleccionada",
        "_": "%d celdas seleccionadas"
    },
    "columns": {
        "1": "1 columna seleccionada",
        "_": "%d columnas seleccionadas"
    },
    "rows": {
        "1": "1 fila seleccionada",
        "_": "%d filas seleccionadas"
    }
},
"thousands": ".",
"datetime": {
    "previous": "Anterior",
    "next": "Proximo",
    "hours": "Horas",
    "minutes": "Minutos",
    "seconds": "Segundos",
    "unknown": "-",
    "amPm": [
        "AM",
        "PM"
    ],
    "months": {
        "0": "Enero",
        "1": "Febrero",
        "10": "Noviembre",
        "11": "Diciembre",
        "2": "Marzo",
        "3": "Abril",
        "4": "Mayo",
        "5": "Junio",
        "6": "Julio",
        "7": "Agosto",
        "8": "Septiembre",
        "9": "Octubre"
    },
    "weekdays": [
        "Dom",
        "Lun",
        "Mar",
        "Mie",
        "Jue",
        "Vie",
        "Sab"
    ]
},
"editor": {
    "close": "Cerrar",
    "create": {
        "button": "Nuevo",
        "title": "Crear Nuevo Registro",
        "submit": "Crear"
    },
    "edit": {
        "button": "Editar",
        "title": "Editar Registro",
        "submit": "Actualizar"
    },
    "remove": {
        "button": "Eliminar",
        "title": "Eliminar Registro",
        "submit": "Eliminar",
        "confirm": {
            "_": "¿Está seguro que desea eliminar %d filas?",
            "1": "¿Está seguro que desea eliminar 1 fila?"
        }
    },
    "error": {
        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
    },
    "multi": {
        "title": "Múltiples Valores",
        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
        "restore": "Deshacer Cambios",
        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
    }
},
"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
"stateRestore": {
    "creationModal": {
        "button": "Crear",
        "name": "Nombre:",
        "order": "Clasificación",
        "paging": "Paginación",
        "search": "Busqueda",
        "select": "Seleccionar",
        "columns": {
            "search": "Búsqueda de Columna",
            "visible": "Visibilidad de Columna"
        },
        "title": "Crear Nuevo Estado",
        "toggleLabel": "Incluir:"
    },
    "emptyError": "El nombre no puede estar vacio",
    "removeConfirm": "¿Seguro que quiere eliminar este %s?",
    "removeError": "Error al eliminar el registro",
    "removeJoiner": "y",
    "removeSubmit": "Eliminar",
    "renameButton": "Cambiar Nombre",
    "renameLabel": "Nuevo nombre para %s",
    "duplicateError": "Ya existe un Estado con este nombre.",
    "emptyStates": "No hay Estados guardados",
    "removeTitle": "Remover Estado",
    "renameTitle": "Cambiar Nombre Estado"
}
} 
});  


datatableLecturas.on('select', function (e, dt, type, indexes) {
  
        if ( type === 'row' ) {
          
         
            document.getElementById("idestudio2").value = datatableLecturas.rows(indexes).data().pluck(0).toArray();
            document.getElementById("estudio2").value = datatableLecturas.rows(indexes).data().pluck(1).toArray();
            document.getElementById("fechaestudio2").value = datatableLecturas.rows(indexes).data().pluck(4).toArray();
            var  informe_html= datatableLecturas.rows(indexes).data().pluck(3).toArray();

            $('#informe2').summernote('reset');
            $('#informe2').summernote('pasteHTML', ConvetidorHtml(informe_html));
  
           }
         
  
    });
*///

/*
    $("#boton_ok2").on("click",function(event){
    event.preventDefault();
    document.getElementById("EditForm").submit();
  console.log("resulta");
 });

 */

  
  
  






//});
  </script>



@endpush
