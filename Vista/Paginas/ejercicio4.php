<?php 
include_once '../layout/header.php'; 
include_once '../../control/persona/abmpersona.php'; 

$abmPersona = new AbmPersona();
$personaSeleccionada = null;

// Verificamos si recibimos el DNI por la URL (método GET desde el botón Editar) 
if (isset($_GET['nroDni'])) {
    // Buscamos específicamente el usuario con ese DNI
    $resultado = $abmPersona->buscar(['nroDni' => $_GET['nroDni']]);
    
    // Si el arreglo nos trajo algo, extraemos el objeto (posición 0)
    if (count($resultado) > 0) {
        $personaSeleccionada = $resultado[0];
    }
}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark text-center">
                    <h4 class="mb-0">Modificar Persona</h4>
                </div>
                <div class="card-body p-4">

                    <?php if ($personaSeleccionada != null): ?>
                        
                        <form action="../action/ejercicio4.php" method="POST" id="formEdicionPersona">
                            
                            <div class="mb-3">
                                <label for="nroDni" class="form-label fw-bold">Número de DNI</label>
                                <input type="number" class="form-control bg-light" id="nroDni" name="nroDni" 
                                       value="<?php echo $personaSeleccionada->getNroDni(); ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label fw-bold">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" 
                                       value="<?php echo $personaSeleccionada->getApellido(); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="nombre" class="form-label fw-bold">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       value="<?php echo $personaSeleccionada->getNombre(); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="fechaNac" class="form-label fw-bold">Fecha Nacimiento</label>
                                <input type="date" class="form-control" id="fechaNac" name="fechaNac" 
                                       value="<?php echo $personaSeleccionada->getFechaNac(); ?>">
                            </div>

                            <div class="mb-4">
                                <label for="telefono" class="form-label fw-bold">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" 
                                       value="<?php echo $personaSeleccionada->getTelefono(); ?>">
                            </div>

                            <div class="mb-4">
                                <label for="domicilio" class="form-label fw-bold">Domicilio</label>
                                <input type="text" class="form-control" id="domicilio" name="domicilio" 
                                       value="<?php echo $personaSeleccionada->getDomicilio(); ?>">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="ejercicio1.php" class="btn btn-secondary me-md-2">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning fw-bold">
                                    Guardar Cambios
                                </button>
                            </div>
                            
                        </form>
                        <script src="../assets/js/ejercicio4.js"></script>

                    <?php else: ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <h5 class="alert-heading">Error</h5>
                            <p>No se encontró la persona solicitada o no se proporcionó un DNI válido.</p>
                            <a href="ejercicio1.php" class="btn btn-outline-danger mt-2">Volver al listado</a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>




<?php include_once '../layout/footer.php'; ?>