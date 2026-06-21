<?php include_once '../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Ingresar Nuevo Auto</h4>
            </div>
            <div class="card-body p-4">
                <form action="../action/ejercicio8.php" method="POST" id="formAuto">
                    
                    <div class="mb-3">
                        <label for="patente" class="form-label fw-bold">Patente</label>
                        <input type="text" class="form-control" id="patente" name="patente" placeholder="Ej: AAA 123">
                    </div>

                    <div class="mb-3">
                        <label for="marca" class="form-label fw-bold">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" placeholder="Ej: Ford">
                    </div>

                    <div class="mb-3">
                        <label for="modelo" class="form-label fw-bold">Modelo</label>
                        <input type="number" class="form-control" id="modelo" name="modelo" placeholder="Ej: 2025">
                    </div>

                    <div class="mb-3">
                        <label for="dniDuenio" class="form-label fw-bold">DNI del dueño</label>
                        <input type="number" class="form-control" id="dniDuenio" name="dniDuenio" placeholder="Ej: 28941234">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Cargar Auto
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/ejercicio8.js"></script>

<?php include_once '../layout/footer.php'; ?>