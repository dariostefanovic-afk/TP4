<?php 

include_once '../../util/funciones.php';
include_once '../../control/auto/abmauto.php';

$datos = data_submitted();
$abmAuto = new AbmAuto();

verEstructura($datos);

if ($abmAuto->baja($datos)) {

    // Todo ok
    $message = 'Valido';
    header("Location: ../paginas/ejercicio7.php?Message=" . urlencode($message));
    exit;

} else {

    // Hubo error
    $message = 'Fallido';
    header("Location: ../paginas/ejercicio7.php?Message=" . urlencode($message));
    exit;
}
?>