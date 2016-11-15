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
                                    <h4> Salas </h4>
                                    @if(Session::has('message'))
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong>{{ Session::get('message') }}</strong>
                                        </div>
                                    @endif                                    
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    {!! Form::open(['route' => 'sala.create', 'method' => 'GET']) !!}
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
                                        <th>Campus</th>
                                        <th>Tipo</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Capacidad</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>                                           
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($salas as $sala)
                                    <tr class="text-center" data-id="{{ $sala->id }}">
                                        <td class="center">{{ $sala->id }}</td>
                                        <td class="center">{{ $sala->campus }}</td>
                                        <td class="center">{{ $sala->tipo }}</td>
                                        <td class="center">{{ $sala->nombre }}</td>
                                        <td class="center">{{ $sala->descripcion }}</td>
                                        <td class="center">{{ $sala->capacidad }}</td>                                        
                                        <td class="center"><a href="{{ route('sala.edit',$sala->id)}}"><i class="fa fa-edit"></i></a></td>
                                        <td class="center"><a href="#!" class="btn-delete"><i class="fa fa-trash"></i></a>
                                        {!! Form::open(['route' => ['sala.destroy', ':SALA_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
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
        responsive: true,
        "language": {
                "decimal":        "",
                "emptyTable":     "Sin datos disponibles",
                "info":           "Mostrando _START_ de _END_ de _TOTAL_ entradas",
                "infoEmpty":      "Mostrando 0 de 0 de 0 entradas",
                "infoFiltered":   "(Filtrado de un total de _MAX_ entradas)",
                "infoPostFix":    "",
                "thousands":      ".",
                "lengthMenu":     "Mostrar _MENU_ entradas",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search":         "Buscar:",
                "zeroRecords":    "Ningún registro encontrado.",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                }
            }
    });

    $('.btn-delete').click(function(e){
        // e.preventDefault(); para evitar que recargue la pagina
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':SALA_ID', id);
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