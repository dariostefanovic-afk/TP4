<?php
class ValidadorPersona
{
    private $nroDni;
    private $apellido;
    private $nombre;
    private $fechaNac;
    private $telefono;
    private $domicilio;

    public function __construct()
    {
        $this->nroDni = "/^\d{8}$/";
        $this->nombre = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/";
        $this->apellido = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/";
        $this->fechaNac = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
        $this->telefono = "/^\d{10}$/";
        $this->domicilio = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9 ]+$/";
    }

    // Getters
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

    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getDomicilio()
    {
        return $this->domicilio;
    }

    // Setters
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

    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }
    /**
     * Modulo correspondiente de validar si los datos son validos
     * @param array $datos
     * @return bool
     */
    public function validarDatos($datos)
    {
        $esValido = false;
        if (
            $this->validarNroDni($datos['nroDni']) &&
            $this->validarTexto($datos['nombre']) &&
            $this->validarTexto($datos['apellido']) &&
            $this->validarFecha($datos['fechaNac']) &&
            $this->validarTelefono($datos['telefono']) &&
            $this->validarDomicilio($datos['domicilio'])
        ) {
            $esValido = true;
        }
        return $esValido;
    }

    /**
     * Modulo correspondiente de validar si el nroDni es valido
     * @param int $nroDni
     * @return bool
     */
    private function validarNroDni($nroDni)
    {
        $esValido = false;
        if (preg_match($this->getNroDni(), $nroDni)) {
            $esValido = true;
        }
        return $esValido;
    }

    /**
     * Modulo correspondiente de validar si el texto es valido
     * @param string $texto
     * @return bool
     */
    private function validarTexto($texto)
    {
        $esValido = false;
        if (preg_match($this->getNombre(), $texto)) {
            $esValido = true;
        }
        return $esValido;
    }

    private function validarFecha($fechaNac)
    {
        $esValido = false;
        if (preg_match($this->getFechaNac(), $fechaNac)) {
            list($anio, $mes, $dia) = explode('-', $fechaNac);
            if (checkdate($mes, $dia, $anio)) {
                $esValido = true;
            }
        }
        return $esValido;
    }
    /**
     * Modulo correspondiente de validar si el telefono es valido
     * @param int $telefono
     * @return bool
     */
    private function validarTelefono($telefono)
    {
        $esValido = false;
        if (preg_match($this->getTelefono(), $telefono)) {
            $esValido = true;
        }
        return $esValido;
    }

    private function validarDomicilio($domicilio)
    {
        $esValido = false;
        if (preg_match($this->getDomicilio(), $domicilio)) {
            $esValido = true;
        }
        return $esValido;
    }
}
