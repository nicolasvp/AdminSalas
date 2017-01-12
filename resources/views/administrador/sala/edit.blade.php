@extends('administrador/main')

@section('container')

            <div class="col-lg-12">
                <h1 class="page-header">Editar Sala: {{ $sala->nombre }}</h1>
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
                                    {!! Form::model($sala, ['route' => ['administrador.sala.update', $sala], 'method' => 'PUT']) !!}
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                                      <div class="form-group">
                                          <label>Campus</label>
                                          <select name="campus" id="campus" class="form-control">
                                          @foreach($campus as $campus)
                                              <option name="campus" id="campus_{{ $campus->id }}" value="{{ $campus->id }}">{{ $campus->nombre }}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label>Tipos</label>
                                          <select name="tipo" id="tipo" class="form-control">
                                          @foreach($tipos as $tipo)
                                              <option name="tipo" id="tipo_{{ $tipo->id }}" value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                       {!! Form::label('nombre', 'Nombre') !!}
                                       {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: m1-201']) !!}
                                      </div>
                                      <div class="form-group">
                                       {!! Form::label('descripcion', 'Descripcion') !!}
                                       {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: 2']) !!}
                                      </div>
                                      <div class="form-group">
                                       {!! Form::label('capacidad', 'Capacidad') !!}
                                       {!! Form::text('capacidad', null,['class' => 'form-control', 'placeholder' => 'Ej: 3']) !!}
                                      </div>

                                      <input type="hidden" id="campus_id" value="{{ $sala->campus_id }}">
                                      <input type="hidden" id="tipo_sala_id" value="{{ $sala->tipo_sala_id }}">

                                      <button type="submit" class="btn btn-success">Aceptar</button>
                                  	{!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@stop

@section('scripts')
<script>
$(document).ready(function(){

  var campus_id = $("#campus_id").val();

  $("#campus option[id='campus_"+campus_id+"']").attr('selected','selected');


  var tipo_sala_id = $("#tipo_sala_id").val();

  $("#tipo option[id='tipo_"+tipo_sala_id+"']").attr('selected','selected');

});
</script>
@stop