@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.sala.index') }}">Salas</a></li>
    <li class="active">Ingresar Sala</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Sala</h2>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <h4> Ingrese los datos </h4>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            {!! Form::open(['route' => ['administrador.sala.upload'], 'method' => 'POST', 'files' => true]) !!}
                             <div class="form-group" style="float:right;">
                                <label>Archivo Excel</label>
                                <button role="button" type="submit" class="btn btn-success" style="float: right;">Subir</button>
                                <input type="file" name="file" class="filestyle"> 
                            </div>
                            {!! Form::close() !!}
                        </div>   
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            {!! Form::open(['route' => ['administrador.sala.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Campus</label>
                                    <select name="campus" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    @foreach($campus as $campus)
                                        <option value="{{ $campus->id }}">{{ $campus->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>                                    
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select name="tipo" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" name="nombre" placeholder="Ej: m1-201" required>
                                </div>                                        
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <input class="form-control" name="descripcion" placeholder="Ej: Sala del edificio m1">
                                </div>
                                <div class="form-group">
                                    <label>Capacidad</label>
                                    <input class="form-control" type="number" name="capacidad" placeholder="Ej: 40" required>
                                </div> 
                                <div class="form-group">
                                    <label>Disponibilidad</label>
                                    <select class="form-control" name="estado" required>
                                        <option value="">Seleccione</option>
                                        <option value="Disponible">Disponible</option>
                                        <option value="No Disponible">No Disponible</option>
                                    </select>
                                </div>   
                                <div class="form-group">
                                    <label>Semestre</label>
                                    <select class="form-control" name="semestre" required>
                                        <option value="">Seleccione</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>                     
                                <div class="form-group">
                                    <label>Año</label>
                                    <input class="form-control" type="number" name="anio" placeholder="Ej: 2017" required>
                                </div>               
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