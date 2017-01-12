@extends('administrador/main')

@section('container')



            <div class="col-lg-12">
                <h1 class="page-header">Carrera</h1>
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
                                    {!! Form::open(['route' => ['administrador.carrera.store'], 'method' => 'POST']) !!}
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" name="nombre" placeholder="Ej: Ingeniería en Informática">
                                        </div>
                                        <div class="form-group">
                                            <label>Código</label>
                                            <input class="form-control" name="codigo" placeholder="Ej: 21030">
                                        </div> 
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input class="form-control" name="descripcion" placeholder="Ej: ingenieria y computacion aplicada..">
                                        </div>                                                                                
                                        <div class="form-group">
                                            <label>Escuela</label>
                                            <select class="form-control" name="escuela">
                                            @foreach($escuelas as $escuela)
                                            <option value="{{ $escuela->id }}">{{ $escuela->nombre }}</option>
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


@stop