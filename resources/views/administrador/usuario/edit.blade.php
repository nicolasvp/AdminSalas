@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.usuario.index') }}">Usuarios</a></li>
    <li class="active">Editar Usuario</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h2 class="page-header">Editar Usuario: {{ $usuario->nombres }} {{ $usuario->apellidos }}</h2>
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
                             {!! Form::number('rut', null,['class' => 'form-control', 'placeholder' => 'Ej: 18117925', 'required']) !!}
                            </div>

                            <div class="form-group">
                             {!! Form::label('email', 'Email') !!}
                             {!! Form::email('email', null,['class' => 'form-control', 'placeholder' => 'Ej: nicolas.vera@ceinf.cl']) !!}
                            </div>

                            <div class="form-group">
                             {!! Form::label('nombres', 'Nombre') !!}
                             {!! Form::text('nombres', null,['class' => 'form-control', 'placeholder' => 'Ej: Nicolás', 'required']) !!}
                            </div>

                            <div class="form-group">
                             {!! Form::label('apellidos', 'Apellido') !!}
                             {!! Form::text('apellidos', null,['class' => 'form-control', 'placeholder' => 'Ej: Vera', 'required']) !!}
                            </div>
                           <label>Roles</label>
                           <div class="form-group" id="roles">
                                @foreach($roles as $rol_u)
                                    <input type="radio" class="rol" id="{{ $rol_u->id }}" value="{{ $rol_u->id }}" name="rol">
                                        {{ $rol_u->nombre }}
                                @endforeach
                           </div>
                            <div class="form-group" id="departamentos" style="display:none">
                                <label>Departamentos</label>
                                <select class="form-control" name="departamento">
                                    <option value="">Seleccione</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>                              
                            <input type="hidden" id="usuario_id" value="{{ $usuario->id }}">
                           <button type="submit" class="btn btn-success">Aceptar</button>
                           <a href="{{ URL::previous() }}" class="btn btn-default" role="button">Cancelar</a>
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
	
  $("#"+{{ $rol_usuario->rol_id }}).attr('checked','checked');

  $(".rol").click(function(){
    if($(this).val() == '3')
        $("#departamentos").css('display','block');
    else
        $("#departamentos").css('display','none');
  });



});
</script>

@stop