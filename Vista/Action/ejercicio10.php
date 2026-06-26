<?php 

include_once '../../util/funciones.php';
include_once '../../control/auto/abmauto.php';
include_once '../../control/persona/abmpersona.php';

$datos = data_submitted();
$abmAuto = new AbmAuto();

if ($abmAuto->validacionDatos($datos)) {
    $abmPersona = new AbmPersona();
    $dni = $datos["dniDuenio"];
    //verEstructura($datos);
    $duenio = $abmPersona->buscar(["nroDni" => $dni]);
    if (count($duenio) == 0) {
        // Hubo error
        $message = 'No existe el dueño';
        header("Location: ../paginas/ejercicio2.php?Message=" . urlencode($message));
        exit;
    }else{
        if ($abmAuto->modificacion($datos)) {
            // Todo ok
            $message = 'Valido';
            header("Location: ../paginas/ejercicio7.php?Message=" . urlencode($message));
            exit;
        } 
    }
}
// Hubo error
$message = 'Fallido';
header("Location: ../paginas/ejercicio8.php?Message=" . urlencode($message));
exit;
?>