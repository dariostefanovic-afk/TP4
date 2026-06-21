<?php 

include_once '../../util/funciones.php';
include_once '../../control/usuario/abmusuario.php';

$datos = data_submitted();
$abmUsuario = new AbmUsuario();

verEstructura($datos);

if ($abmUsuario->baja($datos)) {

    // Todo ok
    $message = 'Valido';
    header("Location: ../paginas/ejercicio1.php?Message=" . urlencode($message));
    exit;

} else {

    // Hubo error
    $message = 'Fallido';
    header("Location: ../paginas/ejercicio1.php?Message=" . urlencode($message));
    exit;
}
?>