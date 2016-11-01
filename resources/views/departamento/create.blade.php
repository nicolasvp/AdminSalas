@extends('main')

@section('container')



            <div class="col-lg-12">
                <h1 class="page-header">Departamento</h1>
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
                                    {!! Form::open(['route' => ['departamento.store'], 'method' => 'POST']) !!}
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" name="nombre" placeholder="Ej: Matemática">
                                        </div>
                                        <div class="form-group">
                                            <label>Facultad</label>
                                            <select name="facultad" class="form-control">
                                            @foreach($facultades as $facultad)
                                                <option name="facultad" value="{{ $facultad->id }}">{{ $facultad->nombre }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input class="form-control" name="descripcion" placeholder="Ej: Departamento de Matemática">
                                        </div>
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                  	{!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@stop