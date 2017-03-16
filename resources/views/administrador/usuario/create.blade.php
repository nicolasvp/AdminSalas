@extends('administrador/main')

@section('option')
    <li><a href="{{ route('administrador.usuario.index') }}">Usuarios</a></li>
    <li class="active">Ingresar Usuario</li>
@stop

@section('container')

    <div class="col-lg-12">
        <h2 class="page-header">Usuario</h2>
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
                            {!! Form::open(['route' => ['administrador.usuario.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label>Rut</label>
                                    <input class="form-control" type="number" name="rut" placeholder="Ej: 18117925" required>
                                </div>   
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="Ej: nicolas.vera@ceinf.cl">
                                </div>                                                                             
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input class="form-control" name="nombres" placeholder="Ej: Nicolás" required>
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input class="form-control" name="apellidos" placeholder="Ej: Vera" required>
                                </div>
                                <label>Rol</label>
                                <div class="form-group">
                                    @foreach($roles as $rol_u)
                                        <input type="radio" class="rol" id="{{ $rol_u->nombre }}" value="{{ $rol_u->id }}" name="rol">
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".rol").click(function(){
            if($(this).val() == '3')
                $("#departamentos").css('display','block');
            else
                $("#departamentos").css('display','none');
        })

    });
</script>
@stop