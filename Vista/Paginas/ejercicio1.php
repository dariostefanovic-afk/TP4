<?php 
include_once '../layout/header.php'; 
include_once '../../control/persona/abmpersona.php'; 

$abmPersona = new AbmPersona();
$listadoPersonas = $abmPersona->buscar(null);
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Listado de Personas</h4>
                    <a href="ejercicio2.php" class="btn btn-light btn-sm fw-bold text-primary">
                        + Nueva Persona
                    </a>
                </div>

                <div class="card-body p-4">
                    
                    <?php if (count($listadoPersonas) > 0): ?>
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped align-middle mb-2">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">DNI</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Fecha Nacimiento</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Domicilio</th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listadoPersonas as $persona): ?>
                                        <tr>
                                            <td class="text-center fw-bold"><?php echo $persona->getNroDni(); ?></td>
                                            <td><?php echo $persona->getApellido(); ?></td>
                                            <td><?php echo $persona->getNombre(); ?></td>
                                            <td><?php echo $persona->getFechaNac(); ?></td>
                                            <td><?php echo $persona->getTelefono(); ?></td>
                                            <td><?php echo $persona->getDomicilio(); ?></td>
                                            <td class="text-center">
                                                <a href="ejercicio4.php?nroDni=<?php echo $persona->getNroDni(); ?>" class="btn btn-warning btn-sm me-2">
                                                    Editar
                                                </a>
                                                <a href="../action/ejercicio3.php?nroDni=<?php echo $persona->getNroDni(); ?>" class="btn btn-danger btn-sm">
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
                            <p class="mb-0">Actualmente no existen personas cargadas en la base de datos.</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>