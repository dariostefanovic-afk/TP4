<?php include_once '../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Cambio de dueño</h4>
            </div>
            <div class="card-body p-4">
                <form action="../action/ejercicio12.php" method="POST" id="formCambioDuenio">
                    
                    <div class="mb-3">
                        <label for="nroDni" class="form-label fw-bold">Número de DNI</label>
                        <input type="number" class="form-control" id="nroDni" name="nroDni" placeholder="Ej: 30111222">
                    </div>

                    <div class="mb-3">
                        <label for="patente" class="form-label fw-bold">Patente</label>
                        <input type="text" class="form-control" id="patente" name="patente" placeholder="Ej: ABC 123">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Cambiar
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/ejercicio12.js"></script>

<?php include_once '../layout/footer.php'; ?>