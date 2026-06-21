<?php
function data_submitted()
{
    $data = array();

    if (!empty($_POST)) {
        $data = $_POST;
    } elseif (!empty($_GET)) {
        $data = $_GET;
    }

    // Si vienen archivos, entonces incluimos este a los datos
    if ($_FILES) {
        $data['archivo'] = $_FILES['archivo'];
    }

    return $data;
}

// Funcion para ver la estructura de los datos
function verEstructura($e)
{
    echo "<pre>";
    print_r($e);
    echo "</pre>";
}