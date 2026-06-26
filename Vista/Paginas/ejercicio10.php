<?php 
include_once '../layout/header.php'; 
include_once '../../control/auto/abmauto.php'; 

$abmAuto = new AbmAuto();
$autoSeleccionado = null;

// Verificamos si recibimos la patente por la URL (método GET desde el botón Editar) 
if (isset($_GET['patente'])) {
    // Buscamos específicamente el auto con esa patente
    $resultado = $abmAuto->buscar(['patente' => $_GET['patente']]);
    
    // Si el arreglo nos trajo algo, extraemos el objeto (posición 0)
    if (count($resultado) > 0) {
        $autoSeleccionado = $resultado[0];
    }
}
?>

<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark text-center">
                    <h4 class="mb-0">Modificar Auto</h4>
                </div>
                <div class="card-body p-4">

                    <?php if ($autoSeleccionado != null): ?>
                        
                        <form action="../action/ejercicio10.php" method="POST" id="formEdicionAuto">
                            
                            <div class="mb-3">
                                <label for="patente" class="form-label fw-bold">Número de Patente</label>
                                <input type="text" class="form-control bg-light" id="patente" name="patente" 
                                       value="<?php echo $autoSeleccionado->getPatente(); ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="marca" class="form-label fw-bold">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca" 
                                       value="<?php echo $autoSeleccionado->getMarca(); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="modelo" class="form-label fw-bold">Modelo</label>
                                <input type="number" class="form-control" id="modelo" name="modelo" 
                                       value="<?php echo $autoSeleccionado->getModelo(); ?>">
                            </div>

                            <div class="mb-4">
                                <label for="dniDuenio" class="form-label fw-bold">DNI del dueño</label>
                                <input type="number" class="form-control" id="dniDuenio" name="dniDuenio" 
                                       value="<?php echo $autoSeleccionado->getDuenio()->getNroDni(); ?>">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="ejercicio7.php" class="btn btn-secondary me-md-2">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning fw-bold">
                                    Guardar Cambios
                                </button>
                            </div>
                            
                        </form>
                        <script src="../assets/js/ejercicio10.js"></script>

                    <?php else: ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <h5 class="alert-heading">Error</h5>
                            <p>No se encontró el auto solicitado o no se proporcionó una patente válida.</p>
                            <a href="ejercicio7.php" class="btn btn-outline-danger mt-2">Volver al listado</a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>




<?php include_once '../layout/footer.php'; ?>