@extends('layouts.plantillaFormularios')

@push('css')
<link rel="stylesheet" href="/assets/js/plugins/dropzone/dropzone.min.css" type="text/css" />
@endpush
@section('title','Editar Radiologos')

@section('nombrevista','Radiologos')
@section('hrefformulario')
{{route('medicos.index')}}
@endsection

@section('tituloformulario','Radiologos')
@section('principalformulario','RADIOLOGOS')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar Radiologos')
@section('classformulario','card')



@section('content') 




    <div class="row">		
                                                
        <div id="profileWidget" class="mb-5">
            
            <div class="card-body">
                    <div class="row">
                        <div class="form-group col-4 m-0">
                        </div>
                        <div class="form-group col-4 m-0">
                            <div class="card border-1 rounded-bottom-0" >
                               
                                <form action="{{route('firmaradiologo.store')}}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    @csrf</form>
                            </div>  
                            
                            <div class="card border-top-0 rounded-top-0">
                                <div class="card-body py-2 px-3">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="fw-600">Firma Radiologo</div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                          
                        </div>
                    </div>
                </div>
        </div>
    </div>  



											<form action="{{route('medicos.update',$medico)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    
                                                    <div class="row">													                                                    
                                                            <div class="form-group col-2 m-0">
                                                                <label class="form-label" for="documento">Documento</label>
                                                                <input type="text" class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento" value="{{old('documento',$medico->documento)}}"  />
                                                                @error('documento')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-5 m-0">
                                                                <label class="form-label" for="nombre">Nombre</label>
                                                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre',$medico->nombre)}}" />
                                                                    @error('nombre')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                   	 											                                                    
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="registro">Registro Medico</label>
                                                            <input type="text" class="form-control" id="registro" name="registro" value="{{old('registro',$medico->registromedico)}}" />
                                                            @error('registro')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-2 m-0">
                                                            <label class="form-label" for="idestado">Estado</label>
															<select class="form-control" id="idestado" name="idestado">
                                                                @foreach ($desplegables as $desplegable)
                                                                <option value="{{$desplegable->id}}" {{$desplegable->id == $medico->idestado ? 'selected' : ''}}>{{$desplegable->nombre}}</option>
                                                                @endforeach
															</select>

                                                        </div>
                                                        
                                                     
                                                    </div>
                                               
                                                
                                                    

                                                    <div class="row">													                                                    
                                                        <div class="form-group col-4 m-0">
                                                         
                                                            <input type="hidden" class="form-control"  id="firma" name="firma" value="{{old('firma',$medico->firma)}}" />
                                                        
                                                        </div>
                                                        
                                                    </div>
                                                 
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar Radiologo</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')
<script src="/assets/js/plugins/dropzone/dropzone.min.js"></script>

<script>

    
       Dropzone.autoDiscover = false;
       const dropzone = new Dropzone('#dropzone',{
        dictDefaultMessage:'Buscar Firma Radiologo',
        acceptedFiles:".pnh,.jpg,.jpeg",
        addRemoveLinks:true,
        dictRemoveFile:'Borrar Archivo',
        maxFiles:1,
        uploadMultiple:false,
        init: function(){
            if(document.querySelector('[name="firma"]').value.trim()){
                const imagenPublicada={};
                imagenPublicada.size=1234;
                imagenPublicada.name=document.querySelector('[name="firma"]').value;
                this.options.addedfile.call(this,imagenPublicada);
                this.options.thumbnail.call(this,imagenPublicada,`/uploads/firmasradiologos/${imagenPublicada.name}`);

                imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
            }
        },
    });
 
    dropzone.on("success",function (file,response){
        document.querySelector('[name="firma"]').value=response.imagen;
    });

     
    dropzone.on("removedfile",function (){
        document.querySelector('[name="firma"]').value='';
    });

    


    </script>



@endpush


