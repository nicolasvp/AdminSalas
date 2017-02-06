@extends('encargado/main')

@section('option')
    <li class="active">Contáctanos</li>
@stop

@section('container')

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Comunícate con nosotros </h4>
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>{{ Session::get('message') }}</strong>
                        </div>
                    @endif                     
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => ['contacto.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Asunto</label>
                                    <input class="form-control" name="asunto" placeholder="Ej: Consulta sobre el horario">
                                </div>   
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="email" placeholder="Ej: nicolas.vera@ceinf.cl">
                                </div>                                                                             
                                <div class="form-group">
                                    <label>Mensaje</label>
                                    <textarea class="form-control" name="mensaje" rows="5" id="mensaje"></textarea>
                                </div>                                       
                                <button type="submit" class="btn btn-success">Enviar</button>
                          	{!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
