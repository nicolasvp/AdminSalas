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
                                    <h4> Facultades </h4>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?php echo Form::open(['route' => 'facultad.create', 'method' => 'GET']); ?>

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
                                        <th>Descripción</th>
                                        <th>Campus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($facultades as $facultad): ?>
                                    <tr class="text-center">
                                        <td class="center"><?php echo e($facultad->id); ?></td>
                                        <td class="center"><?php echo e($facultad->nombre); ?></td>
                                        <td class="center"><?php echo e($facultad->descripcion); ?></td>
                                        <td class="center"><?php echo e($facultad->campus); ?></td>
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
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>