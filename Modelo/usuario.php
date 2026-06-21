<?php
include_once("conector/dataBase.php");

class Usuario
{
    // Atributos privados correspondientes a las columnas de la tabla 'usuario'
    private $nroDni;
    private $nombre;
    private $apellido;
    private $telefono;

    // Inicializamos todos los atributos vacíos en el constructor
    public function __construct()
    {
        $this->nroDni = "";
        $this->nombre = "";
        $this->apellido = "";
        $this->telefono = "";
    }

    // ==========================================
    // MÉTODOS GET
    // ==========================================
    public function getNroDni()
    {
        return $this->nroDni;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }

    // ==========================================
    // MÉTODOS SET
    // ==========================================
    public function setNroDni($nroDni)
    {
        $this->nroDni = $nroDni;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Función encargada de setear todos los atributos de la clase de una vez.
     * Útil para cuando recuperamos datos de la base o desde el Controller (ABM).
     */
    public function setear($nroDni, $nombre, $apellido, $telefono)
    {
        $this->setNroDni($nroDni);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setTelefono($telefono);
    }

    /**
     * Módulo cargar
     * Busca en la BD un registro por su nroDni y carga los datos en el objeto actual.
     * @return bool
     */
    public function cargar()
    {
        $resp = false;
        $base = new dataBase();
        $nroDni = $this->getNroDni();

        // nroDni es INT, no necesita comillas en la consulta SQL
        $sql = "SELECT * FROM usuario WHERE nroDni = " . $nroDni;

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['nroDni'], $row['nombre'], $row['apellido'], $row['telefono']);
                    $resp = true;
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

        $nroDni = $this->getNroDni();
        $nombre = $this->getNombre();
        $apellido = $this->getApellido();
        $telefono = $this->getTelefono();

        // Los VARCHAR llevan comillas simples (''), el INT (nroDni) no.
        $sql = "INSERT INTO usuario (nroDni, nombre, apellido, telefono) 
                VALUES ($nroDni, '$nombre', '$apellido', '$telefono')";

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

        $nroDni = $this->getNroDni();
        $nombre = $this->getNombre();
        $apellido = $this->getApellido();
        $telefono = $this->getTelefono();

        $sql = "UPDATE usuario SET 
                    nombre = '$nombre', 
                    apellido = '$apellido', 
                    telefono = '$telefono' 
                WHERE nroDni = $nroDni";

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
        $nroDni = $this->getNroDni();

        $sql = "DELETE FROM usuario WHERE nroDni = $nroDni";

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
        $sql = "SELECT * FROM usuario";

        if ($condicion != "") {
            $sql .= " WHERE " . $condicion;
        }
        $sql .= " ORDER BY nroDni ";

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $base->Registro()) {
                        $obj = new Usuario();
                        $obj->setear($row['nroDni'], $row['nombre'], $row['apellido'], $row['telefono']);
                        array_push($arreglo, $obj);
                    }
                }
            }
        }
        return $arreglo;
    }
}
