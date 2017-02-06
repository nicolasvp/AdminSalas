@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.sala.index') }}">Salas</a></li>
    <li class="active">Ingresar Sala</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h1 class="page-header">Sala</h1>
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
                            {!! Form::open(['route' => ['administrador.sala.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Campus</label>
                                    <select name="campus" class="form-control">
                                    @foreach($campus as $campus)
                                        <option name="campus" value="{{ $campus->id }}">{{ $campus->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>                                    
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select name="tipo" class="form-control">
                                    @foreach($tipos as $tipo)
                                        <option name="tipo" value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: m1-201">
                                </div>                                        
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <input class="form-control" name="descripcion" placeholder="Ej: Sala del edificio m1">
                                </div>
                                <div class="form-group">
                                    <label>Capacidad</label>
                                    <input class="form-control" name="capacidad" placeholder="Ej: 40">
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