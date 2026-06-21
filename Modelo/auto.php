<?php
include_once("conector/dataBase.php");
include_once("persona.php");

class Auto
{
    // Atributos privados correspondientes a las columnas de la tabla 'auto'
    private $patente;
    private $marca;
    private $modelo;
    private $objDuenio;

    // Inicializamos todos los atributos vacíos en el constructor
    public function __construct()
    {
        $this->patente = "";
        $this->marca = "";
        $this->modelo = "";
        $this->objDuenio = null;
    }

    // ==========================================
    // MÉTODOS GET
    // ==========================================
    public function getPatente()
    {
        return $this->patente;
    }
    public function getMarca()
    {
        return $this->marca;
    }
    public function getModelo()
    {
        return $this->modelo;
    }
    public function getDuenio()
    {
        return $this->objDuenio;
    }

    // ==========================================
    // MÉTODOS SET
    // ==========================================
    public function setPatente($patente)
    {
        $this->patente = $patente;
    }
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }
    public function setDuenio($duenio)
    {
        $this->objDuenio = $duenio;
    }

    /**
     * Función encargada de setear todos los atributos de la clase de una vez.
     * Útil para cuando recuperamos datos de la base o desde el Controller (ABM).
     */
    public function setear($patente, $marca, $modelo, $duenio)
    {
        $this->setPatente($patente);
        $this->setMarca($marca);
        $this->setModelo($modelo);
        $this->setDuenio($duenio);
    }

    /**
     * Módulo cargar
     * Busca en la BD un registro por su patente y carga los datos en el objeto actual.
     * @return bool
     */
    public function cargar()
    {
        $resp = false;
        $base = new dataBase();
        $patente = $this->getPatente();

        // nroDni es INT, no necesita comillas en la consulta SQL
        $sql = "SELECT * FROM auto WHERE patente = " . '$patente';

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $consulta = "SELECT * FROM persona WHERE nroDni = ". $row['dniDuenio'];
                    $resul = $base->Ejecutar($consulta);
                    if ($resul > 0) {
                        $reg = $base->Registro();
                        $duenio = new Persona();
                        $duenio->setear($reg['nroDni'], $reg['apellido'], $reg['nombre'], 
                        $reg['fechaNac'], $reg['telefono'], $reg['domicilio']);
                        $this->setear($row['patente'], $row['marca'], $row['modelo'], $duenio);
                        $resp = true;
                    }
                }
            }
        }
        return $resp;
    }

    /**
     * Módulo insertar
     * Inserta los datos del objeto actual como un nuevo registro en la BD.
     * @return bool
     */
    public function insertar()
    {
        $resp = false;
        $base = new dataBase();

        $patente = $this->getPatente();
        $marca = $this->getMarca();
        $modelo = $this->getModelo();
        $objDuenio = $this->getDuenio();
        $dniDuenio = $objDuenio->getNroDni();

        // Los VARCHAR llevan comillas simples (''), el INT (nroDni) no.
        $sql = "INSERT INTO auto (patente, marca, modelo, dniDuenio) 
                VALUES ('$patente', '$marca', $modelo, $dniDuenio)";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql) !== 0) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Módulo modificar
     * Actualiza un registro en la BD usando el nroDni como identificador (Primary Key).
     * @return bool
     */
    public function modificar()
    {
        $resp = false;
        $base = new dataBase();

        $patente = $this->getPatente();
        $marca = $this->getMarca();
        $modelo = $this->getModelo();
        $objDuenio = $this->getDuenio();
        $dniDuenio = $objDuenio->getNroDni();

        $sql = "UPDATE auto SET 
                    marca = '$marca',
                    modelo = $modelo,  
                    dniDuenio = $dniDuenio
                WHERE patente = '$patente'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql) !== false) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Módulo eliminar
     * Elimina el registro de la BD correspondiente al nroDni del objeto.
     * @return bool
     */
    public function eliminar()
    {
        $resp = false;
        $base = new dataBase();
        $patente = $this->getPatente();

        $sql = "DELETE FROM auto WHERE patente = '$patente'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql) > 0) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Módulo seleccionar
     * Retorna un arreglo de objetos Usuario que cumplan con una condición dada.
     * @param string $condicion (ej: "nombre = 'Juan'")
     * @return array
     */
    public static function seleccionar($condicion = "")
    {
        $arreglo = array();
        $base = new dataBase();
        $sql = "SELECT * FROM auto";

        if ($condicion != "") {
            $sql .= " WHERE " . $condicion;
        }
        $sql .= " ORDER BY patente ";

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $basePersona = new dataBase();
                    while ($row = $base->Registro()) {
                        $consulta = "SELECT * FROM persona WHERE nroDni = ". $row['dniDuenio'];
                        $resul = $basePersona->Ejecutar($consulta);
                        $duenio = new Persona();
                        if ($resul > 0) {
                            $reg = $basePersona->Registro();
                            $duenio->setear($reg['nroDni'], $reg['apellido'], $reg['nombre'], 
                            $reg['fechaNac'], $reg['telefono'], $reg['domicilio']);
                        }
                        $obj = new Auto();
                        $obj->setear($row['patente'], $row['marca'], $row['modelo'], $duenio);
                        array_push($arreglo, $obj);
                    }
                }
            }
        }
        return $arreglo;
    }
}
