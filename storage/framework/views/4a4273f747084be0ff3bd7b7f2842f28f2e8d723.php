<?php $__env->startSection('container'); ?>



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
                                    <?php echo Form::open(['route' => ['usuario.store'], 'method' => 'POST']); ?>

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
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                  	<?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>