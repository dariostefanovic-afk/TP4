<?php
class ValidadorUsuario
{
    private $nroDni;
    private $nombre;
    private $apellido;
    private $telefono;

    public function __construct()
    {
        $this->nroDni = "/^\d{8}$/";
        $this->nombre = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/";
        $this->apellido = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/";
        $this->telefono = "/^\d{10}$/";
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

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setNroDni($nroDni)
    {
        $this->nroDni = $nroDni;
    }

    // Setters
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
            $this->validarTelefono($datos['telefono'])
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
}
