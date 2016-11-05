@extends('main')

@section('style')
   <!-- DataTables CSS -->
    <link href="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

   <!-- DataTables Responsive CSS -->
    <link href="{{ asset('vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@stop

@section('container')

                <div class="col-lg-12" style="padding-top: 20px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <h4> Docentes </h4>
                                    @if(Session::has('message'))
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong>{{ Session::get('message') }}</strong>
                                        </div>
                                    @endif                                    
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    {!! Form::open(['route' => 'docente.create', 'method' => 'GET']) !!}
                                        <button type="submit" class="btn btn-success" style="float: right">Ingresar  <i class="fa fa-plus"></i></button>
                                    {!! Form::close() !!}
                               </div>
                           </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Rut</th>
                                        <th>Email</th>
                                        <th>Departamento</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($docentes as $docente)
                                    <tr class="text-center" data-id="{{ $docente->id }}">
                                        <td class="center">{{ $docente->id }}</td>
                                        <td class="center">{{ $docente->nombres }}</td>
                                        <td class="center">{{ $docente->apellidos }}</td>
                                        <td class="center">{{ $docente->rut }}</td>
                                        <td class="center">{{ $docente->email}}</td>
                                        <td class="center">{{ $docente->departamento }}</td>
                                        <td class="center"><a href="{{ route('docente.edit',$docente->id)}}"><i class="fa fa-edit"></i></a></td>
                                        <td class="center"><a href="#!" class="btn-delete"><i class="fa fa-trash"></i></a>
                                        {!! Form::open(['route' => ['docente.destroy', ':DOCENTE_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
                                        {!! Form::close() !!}
                                        </td>                                         
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->


@stop

@section('scripts')

<!-- DataTables JavaScript -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/dataTables.responsive.js') }}"></script>

<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
    
    $('.btn-delete').click(function(e){
        // e.preventDefault(); para evitar que recargue la pagina
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':DOCENTE_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
        // alert(result.message);
          if(result == 'ok')
            row.fadeOut();
          if(result == 'fail')
           console.log('El registro no fue eliminado');
        }).fail(function(){
           console("fail: El registro no fue eliminado");
           row.show();
        });

    });      
});
</script>

@stop