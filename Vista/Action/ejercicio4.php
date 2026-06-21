<?php 

include_once '../../util/funciones.php';
include_once '../../control/persona/abmpersona.php';

$datos = data_submitted();
$abmPersona = new AbmPersona();

verEstructura($datos);

if ($abmPersona->validacionModificacion($datos)) {

    // Todo ok
    $message = 'Valido';
    header("Location: ../paginas/ejercicio1.php?Message=" . urlencode($message));
    exit;

} else {

    // Hubo error
    $message = 'Fallido';
    header("Location: ../paginas/ejercicio4.php?Message=" . urlencode($message));
    exit;
}
?>