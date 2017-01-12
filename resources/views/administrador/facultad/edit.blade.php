@extends('administrador/main')

@section('container')



            <div class="col-lg-12">
                <h1 class="page-header">Editar Facultad: {{ $facultad->nombre }}</h1>
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
                                    {!! Form::model($facultad, ['route' => ['administrador.facultad.update', $facultad], 'method' => 'PUT']) !!}
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                      <div class="form-group">
                                       {!! Form::label('nombre', 'Nombre') !!}
                                       {!! Form::text('nombre', null,['class' => 'form-control', 'placeholder' => 'Ej: Ingeniería']) !!}
                                      </div>

                                      <div class="form-group">
                                          <label>Campus</label>
                                          <select name="campus" id="campus" class="form-control">
                                          @foreach($campus as $c)
                                              <option name="campus" id="campus_{{ $c->id }}" value="{{ $c->id }}">{{ $c->nombre }}</option>
                                          @endforeach
                                          </select>
                                      </div>

                                      <div class="form-group">
                                       {!! Form::label('descripcion', 'Descripción') !!}
                                       {!! Form::text('descripcion', null,['class' => 'form-control', 'placeholder' => 'Ej: Ingenieria y Ciencias..']) !!}
                                      </div>

                                      <input type="hidden" id="campus_id" value="{{ $facultad->campus_id }}">

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

});
</script>
@stop