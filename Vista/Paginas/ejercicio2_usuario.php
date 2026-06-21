<?php include_once '../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Ingresar Nuevo Usuario</h4>
            </div>
            <div class="card-body p-4">
                <form action="../action/ejercicio2.php" method="POST" id="formUsuario">
                    
                    <div class="mb-3">
                        <label for="nroDni" class="form-label fw-bold">Número de DNI</label>
                        <input type="number" class="form-control" id="nroDni" name="nroDni" placeholder="Ej: 30111222">
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Juan">
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label fw-bold">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ej: Perez">
                    </div>

                    <div class="mb-4">
                        <label for="telefono" class="form-label fw-bold">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej: 2994123456">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Cargar Usuario
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/ejercicio2.js"></script>

<?php include_once '../layout/footer.php'; ?>