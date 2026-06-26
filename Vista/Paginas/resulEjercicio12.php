<?php
include_once '../Layout/header.php';
?>

<?php

if (isset($_GET['Message'])):
    $esExito = $_GET['Message'] == "Valido";
    
    $claseAlert = $esExito ? 'alert-success' : 'alert-danger';
    $titulo = $esExito ? '¡Excelente! Se realizó el cambio de dueño' : '¡Hubo un problema!';

?>

<div class="row justify-content-center mb-4">
    <div class="col-md-6">
        <div class="alert <?php echo $claseAlert; ?> alert-dismissible fade show shadow-sm" role="alert">
            <strong><?php echo $titulo; ?></strong>

            <?php
            if (!$esExito)
                echo "<strong><div class='alert alert-danger' class='text-center mt-3'>" . htmlspecialchars($_GET['Message']) . "</div></strong>";
            ?>    
                <div class="text-center mt-3">
                    <a href="ejercicio7.php" class="btn btn-primary">Volver</a>
                </div>
            <?php    
                exit;
            ?>

        </div>
    </div>
</div>
<?php endif; ?>
<?php
include_once '../Layout/footer.php';
?>