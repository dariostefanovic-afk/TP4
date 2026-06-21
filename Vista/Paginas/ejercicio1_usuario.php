<?php 
include_once '../layout/header.php'; 
include_once '../../control/usuario/abmusuario.php'; 

$abmUsuario = new AbmUsuario();
$listadoUsuarios = $abmUsuario->buscar(null);
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Listado de Usuarios</h4>
                    <a href="ejercicio2.php" class="btn btn-light btn-sm fw-bold text-primary">
                        + Nuevo Usuario
                    </a>
                </div>

                <div class="card-body p-4">
                    
                    <?php if (count($listadoUsuarios) > 0): ?>
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">DNI</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listadoUsuarios as $usuario): ?>
                                        <tr>
                                            <td class="text-center fw-bold"><?php echo $usuario->getNroDni(); ?></td>
                                            <td><?php echo $usuario->getNombre(); ?></td>
                                            <td><?php echo $usuario->getApellido(); ?></td>
                                            <td><?php echo $usuario->getTelefono(); ?></td>
                                            <td class="text-center">
                                                <a href="ejercicio4.php?nroDni=<?php echo $usuario->getNroDni(); ?>" class="btn btn-warning btn-sm me-2">
                                                    Editar
                                                </a>
                                                <a href="../action/ejercicio3.php?nroDni=<?php echo $usuario->getNroDni(); ?>" class="btn btn-danger btn-sm">
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
                            <p class="mb-0">Actualmente no existen usuarios cargados en la base de datos.</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>