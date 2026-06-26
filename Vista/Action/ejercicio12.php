<?php 

include_once '../../util/funciones.php';
include_once '../../control/auto/abmauto.php';
include_once '../../control/persona/abmpersona.php';

$datos = data_submitted();
$abmAuto = new AbmAuto();

if ($abmAuto->validacionDatosCambioDuenio($datos)) {
    $abmPersona = new AbmPersona();
    $dni = $datos["nroDni"];
    //verEstructura($datos);
    $duenio = $abmPersona->buscar(["nroDni" => $dni]);
    $patente = $datos["patente"];
    $auto = $abmAuto->buscar(["patente" => $patente]);
    if (count($duenio) == 0) {
        // Hubo error
        $message = 'No existe el dueño';
        header("Location: ../paginas/resulEjercicio12.php?Message=" . urlencode($message));
        exit;
    }elseif (count($auto) == 0) {
        $message = 'No existe el auto';
        header("Location: ../paginas/resulEjercicio12.php?Message=" . urlencode($message));
        exit;
        }else{
            $reg['patente'] = $auto[0]->getPatente();
            $reg['marca'] = $auto[0]->getMarca();
            $reg['modelo'] = $auto[0]->getModelo();
            $reg['dniDuenio'] = $dni;
            if ($abmAuto->modificacion($reg)) {
                // Todo ok
                $message = 'Valido';
                header("Location: ../paginas/resulEjercicio12.php?Message=" . urlencode($message));
                exit;
            }
        }
}
// Hubo error
$message = 'Los datos ingresados no son validos';
header("Location: ../paginas/resulEjercicio12.php?Message=" . urlencode($message));
?>