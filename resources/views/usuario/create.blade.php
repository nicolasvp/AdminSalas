@extends('main')

@section('container')



            <div class="col-lg-12">
                <h1 class="page-header">Usuario</h1>
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
                                    {!! Form::open(['route' => ['usuario.store'], 'method' => 'POST']) !!}
                                        <div class="form-group">
                                            <label>Rut</label>
                                            <input class="form-control" name="rut" placeholder="Ej: 18117925-2">
                                        </div>   
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" placeholder="Ej: nicolas.vera@ceinf.cl">
                                        </div>                                                                             
                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input class="form-control" name="nombres" placeholder="Ej: Nicolás">
                                        </div>
                                        <div class="form-group">
                                            <label>Apellidos</label>
                                            <input class="form-control" name="apellidos" placeholder="Ej: Vera">
                                        </div>
                                        <label>Roles</label>
                                        <div class="form-group">
                                            @foreach($roles as $rol)
	                                            <input type="checkbox" id="{{ $rol->nombre }}" value="{{ $rol->id }}" name="roles[]">
	                                                {{ $rol->nombre }}
                                            @endforeach
                                        </div>                                        
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                  	{!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@stop