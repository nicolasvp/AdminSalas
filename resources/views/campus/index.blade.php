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
                                    <h4> Campus </h4>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    {!! Form::open(['route' => 'campus.create', 'method' => 'GET']) !!}
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
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Descripción</th>
                                        <th>Encargado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($campus as $c)
                                    <tr class="text-center">
                                        <td class="center">{{ $c->id }}</td>
                                        <td class="center">{{ $c->nombre }}</td>
                                        <td class="center">{{ $c->direccion }}</td>
                                        <td class="center">{{ $c->descripcion }}</td>
                                        <td class="center">{{ $c->rut_encargado }}</td>
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
});
</script>

@stop