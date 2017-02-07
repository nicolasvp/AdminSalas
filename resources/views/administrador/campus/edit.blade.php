@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.campus.index') }}">Campus</a></li>
    <li class="active">Editar Campus</li>
@stop

@section('container')

  <div class="col-lg-12">
      <h1 class="page-header">Editar Campus: {{ $campus->nombre }}</h1>
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
                        {!! Form::model($campus, ['route' => ['administrador.campus.update', $campus], 'method' => 'PUT']) !!}
                          <div class="form-group">
                           {!! Form::label('nombre', 'Nombre') !!}
                           {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: Macul']) !!}
                          </div>

                          <div class="form-group">
                           {!! Form::label('direccion', 'Dirección') !!}
                           {!! Form::text('direccion', null,['class' => 'form-control', 'placeholder' => 'Ej: Jose Pedro Alessandri #123']) !!}
                          </div>

                          <div class="form-group">
                           {!! Form::label('descripcion', 'Descripción') !!}
                           {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: Campus de Ingenieria y Ciencias..']) !!}
                          </div>

                          <div class="form-group">
                           {!! Form::label('encargado', 'Encargado') !!}
                            <select class="form-control" name="encargado" id="encargado">
                            @foreach($encargados as $encargado)
                              <option name="encargado" id="encargado_{{ $encargado->rut }}" value="{{ $encargado->rut }}">{{ $encargado->rut }}</option>
                            @endforeach
                            </select>                               
                          </div>

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
<script type="text/javascript">

 $(document).ready(function(){

  $("#encargado option[id='encargado_"+{{ $campus->rut_encargado }}+"']").attr('selected','selected');

 });

</script>
@stop