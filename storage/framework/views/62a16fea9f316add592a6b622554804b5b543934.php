<?php $__env->startSection('style'); ?>
   <!-- DataTables CSS -->
    <link href="<?php echo e(asset('vendor/datatables-plugins/dataTables.bootstrap.css')); ?>" rel="stylesheet">

   <!-- DataTables Responsive CSS -->
    <link href="<?php echo e(asset('vendor/datatables-responsive/dataTables.responsive.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

                <div class="col-lg-12" style="padding-top: 20px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <h4> Campus </h4>
                                    <?php if(Session::has('message')): ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong><?php echo e(Session::get('message')); ?></strong>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?php echo Form::open(['route' => 'campus.create', 'method' => 'GET']); ?>

                                        <button type="submit" class="btn btn-success" style="float: right">Ingresar  <i class="fa fa-plus"></i></button>
                                    <?php echo Form::close(); ?>

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
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($campus as $c): ?>
                                    <tr class="text-center" data-id="<?php echo e($c->id); ?>">
                                        <td class="center"><?php echo e($c->id); ?></td>
                                        <td class="center"><?php echo e($c->nombre); ?></td>
                                        <td class="center"><?php echo e($c->direccion); ?></td>
                                        <td class="center"><?php echo e($c->descripcion); ?></td>
                                        <td class="center"><?php echo e($c->rut_encargado); ?></td>
                                        <td class="center"><a href="<?php echo e(route('campus.edit',$c->id)); ?>"><i class="fa fa-edit"></i></a></td>
                                        <td class="center"><a href="#!" class="btn-delete"><i class="fa fa-trash"></i></a>
                                        <?php echo Form::open(['route' => ['campus.destroy', ':CAMPUS_ID'], 'method' => 'DELETE', 'id' => 'form-delete']); ?>

                                        <?php echo Form::close(); ?>

                                        </td>                                        
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- DataTables JavaScript -->
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/datatables-responsive/dataTables.responsive.js')); ?>"></script>

<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('.btn-delete').click(function(e){
        //  e.preventDefault(); para evitar que recargue la pagina
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':CAMPUS_ID', id);
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>