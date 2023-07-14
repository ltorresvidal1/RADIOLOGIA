@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Crear Salas')

@section('nombrevista','Salas')
@section('hrefformulario')
{{route('rissalas.index')}}
@endsection

@section('tituloformulario','Salas')
@section('principalformulario','SALAS')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear Nueva Sala')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rissalas.store')}}" method="POST">
                                                @csrf
                                                
                                                    
                                                            <div class="row">	
                                                            <div class="form-group col-8 m-0">
                                                                <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre')}}" />
                                                                    @error('nombre')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-4 m-0">
                                                                <label class="form-label" for="sede_id">Sedes</label>
                                                                <select class="form-select  @error('sede_id') is-invalid @enderror" id="sede_id" name="sede_id">
                                                                    <option value="0">Seleccionar</option>
                                                                    @foreach ($sedes as $sede)
                                                                    <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-4 m-0">
                                                                <label class="form-label" for="idestado">Estado</label>
                                                                <select class="form-select" id="idestado" name="idestado">
                                                                    @foreach ($estados as $estado)
                                                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                         
                                                    
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Crear Sala</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')




@endpush


