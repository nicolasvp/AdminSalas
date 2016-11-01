<?php $__env->startSection('container'); ?>



            <div class="col-lg-12">
                <h1 class="page-header">Campus</h1>
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
                                    <?php echo Form::open(['route' => ['campus.store'], 'method' => 'POST']); ?>

                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" name="nombre" placeholder="Ej: Macul">
                                        </div>
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input class="form-control" name="direccion" placeholder="Ej: Jose Pedro Alessandri #123">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input class="form-control" name="descripcion" placeholder="Ej: Campus de Ingenieria y Ciencias..">
                                        </div>
                                        <div class="form-group">
                                            <label>Rut Encargado</label>
                                            <input class="form-control" name="rut_encargado" placeholder="Ej: 18117925-2">
                                        </div>
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                  	<?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>