<?php 

include_once '../../util/funciones.php';
include_once '../../control/auto/abmauto.php';
include_once '../../control/persona/abmpersona.php';

$datos = data_submitted();
$abmAuto = new AbmAuto();
// $abmPersona = new AbmPersona();
// $dni = $datos["dniDuenio"];

// //verEstructura($datos);

// $duenio = $abmPersona->buscar(["nroDni" => $dni]);

// if (count($duenio) == 0) {
//     echo "
//     <div class='alert alert-danger'>
//         <h4 class='alert-heading'>Dueño no encontrado</h4>
//         <p>No existe una persona con DNI <strong>$dni</strong>.</p>
//         <hr>
//         <a href='../paginas/ejercicio2.php' class='btn btn-primary'>Cargar nueva persona</a>
//         <a href='../paginas/ejercicio8.php' class='btn btn-secondary'>Volver</a>
//     </div>";
//     // $message = 'Fallido';
//     // header("Location: ../paginas/ejercicio2.php?Message=" . urlencode($message));
//     exit;
// }

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
        if ($abmAuto->alta($datos)) {
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