@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.usuario.index') }}">Usuarios</a></li>
    <li class="active">Editar Usuario</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h1 class="page-header">Editar Usuario: {{ $usuario->nombres }} {{ $usuario->apellidos }}</h1>
  </div>
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h4> Ingrese los datos </h4>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-lg-6">
                          {!! Form::model($usuario, ['route' => ['administrador.usuario.update', $usuario], 'method' => 'PUT']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                            <div class="form-group">
                             {!! Form::label('rut', 'Rut') !!}
                             {!! Form::text('rut', null,['class' => 'form-control', 'placeholder' => 'Ej: 18117925']) !!}
                            </div>

                            <div class="form-group">
                             {!! Form::label('email', 'Email') !!}
                             {!! Form::text('email', null,['class' => 'form-control', 'placeholder' => 'Ej: nicolas.vera@ceinf.cl']) !!}
                            </div>

                            <div class="form-group">
                             {!! Form::label('nombres', 'Nombre') !!}
                             {!! Form::text('nombres', null,['class' => 'form-control', 'placeholder' => 'Ej: Nicolás']) !!}
                            </div>

                            <div class="form-group">
                             {!! Form::label('apellidos', 'Apellido') !!}
                             {!! Form::text('apellidos', null,['class' => 'form-control', 'placeholder' => 'Ej: Vera']) !!}
                            </div>
                           <label>Roles</label>
                           <div class="form-group" id="roles">

                           </div>  
                            <input type="hidden" id="usuario_id" value="{{ $usuario->rut }}">
                           <button type="submit" class="btn btn-success">Aceptar</button>
                        	{!! Form::close() !!}
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

@stop

@section('scripts')
<script>
$(document).ready(function(){

  var id = $("#usuario_id").val();

  $.ajax({
     
    // con .val saco el valor del value
        data:  {'id': id},
        url:   '/~nvera/administrador/usuario/'+id+'/edit',
        type:  'get',
        dataType: 'json',
        success:  function(respuesta) {          
          $.each(respuesta['roles'], function(k,v){

            $("#roles").append("<input id='"+v.id+"' type='checkbox' value='"+v.id+"' name='roles[]'>"+v.nombre);
            $.each(respuesta['roles_usuario'], function(key,value){
              if(value.rol_id == v.id)
                $("#"+v.id).prop("checked",true);
            });
          });
        }
    });

});
</script>

@stop