@extends('administrador/main')

@section('style')
   <!-- DataTables CSS -->
    <link href="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

   <!-- DataTables Responsive CSS -->
    <link href="{{ asset('vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@stop

@section('option')
    <li class="active">Cursos</li>
@stop

@section('container')

    <div class="col-lg-12" style="padding-top: 20px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h2> Cursos </h2>
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                        @endif                                    
                    </div>
                    <div class="col-md-6 col-lg-6">
                        {!! Form::open(['route' => 'administrador.curso.create', 'method' => 'GET']) !!}
                            <button type="submit" class="btn btn-success" style="float: right; margin-top: 10px;">Ingresar  <i class="fa fa-plus"></i></button>
                        {!! Form::close() !!}

                        {!! Form::open(['route' => 'administrador.curso.download', 'method' => 'GET']) !!}
                            <button type="submit" class="btn btn-info pull-right" style="margin-top: 10px;">Descargar <i class="fa fa-download"></i></button>
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
                            <th>Asignatura</th>
                            <th>Docente</th>
                            <th>Semestre</th>
                            <th>Año</th>
                            <th>Seccion</th>
                            <th>Editar</th>
                            <th>Eliminar</th>                                           
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cursos as $curso)
                        <tr class="text-center" data-id="{{ $curso->id }}">
                            <td class="center">{{ $curso->id }}</td>
                            <td class="center">{{ $curso->asignatura }}</td>
                            <td class="center">{{ $curso->nombres }} {{ $curso->apellidos }}</td>
                            <td class="center">{{ $curso->semestre }}</td>
                            <td class="center">{{ $curso->anio }}</td>
                            <td class="center">{{ $curso->seccion }}</td>                                        
                            <td class="center"><a href="{{ route('administrador.curso.edit',$curso->id)}}"><i class="fa fa-edit"></i></a></td>
                            <td class="center"><a href="#!" class="btn-delete"><i class="fa fa-trash"></i></a>
                            {!! Form::open(['route' => ['administrador.curso.destroy', ':CURSO_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
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
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
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

   
});

$(document).on('click','.btn-delete',function(e){
    // e.preventDefault(); para evitar que recargue la pagina
    var row = $(this).parents('tr');
    var id = row.data('id');
    var form = $('#form-delete');
    var url = form.attr('action').replace(':CURSO_ID', id);
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
    
</script>

@stop