<?php $__env->startSection('container'); ?>



            <div class="col-lg-12">
                <h1 class="page-header">Departamento</h1>
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
                                    <?php echo Form::open(['route' => ['departamento.store'], 'method' => 'POST']); ?>

                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" name="nombre" placeholder="Ej: Matemática">
                                        </div>
                                        <div class="form-group">
                                            <label>Facultad</label>
                                            <select name="facultad" class="form-control">
                                            <?php foreach($facultades as $facultad): ?>
                                                <option name="facultad" value="<?php echo e($facultad->id); ?>"><?php echo e($facultad->nombre); ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input class="form-control" name="descripcion" placeholder="Ej: Departamento de Matemática">
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