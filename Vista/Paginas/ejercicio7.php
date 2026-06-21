<?php 
include_once '../layout/header.php'; 
include_once '../../control/auto/abmauto.php'; 

$abmAuto = new AbmAuto();
$listadoAutos = $abmAuto->buscar(null);
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Listado de Autos</h4>
                    <a href="ejercicio8.php" class="btn btn-light btn-sm fw-bold text-primary">
                        + Nuevo Auto
                    </a>
                </div>

                <div class="card-body p-4">
                    
                    <?php if (count($listadoAutos) > 0): ?>
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped align-middle mb-2">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">Patente</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">DNI del dueño</th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listadoAutos as $auto): ?>
                                        <tr>
                                            <td class="text-center fw-bold"><?php echo $auto->getPatente(); ?></td>
                                            <td><?php echo $auto->getMarca(); ?></td>
                                            <td><?php echo $auto->getModelo(); ?></td>
                                            <td><?php 
                                                $duenio = $auto->getDuenio();
                                                echo $duenio->getNroDni(); 
                                                ?></td>
                                            <td class="text-center">
                                                <a href="ejercicio10.php?patente=<?php echo $auto->getPatente(); ?>" class="btn btn-warning btn-sm me-2">
                                                    Editar
                                                </a>
                                                <a href="../action/ejercicio9.php?patente=<?php echo $auto->getPatente(); ?>" class="btn btn-danger btn-sm">
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    <?php else: ?>
                        <div class="alert alert-info text-center mb-0" role="alert">
                            <h5 class="alert-heading mb-1">¡No hay registros!</h5>
                            <p class="mb-0">Actualmente no existen autos cargados en la base de datos.</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>