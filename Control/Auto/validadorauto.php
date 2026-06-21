<?php
class ValidadorAuto
{
    private $patente;
    private $marca;
    private $modelo;
    private $nroDni;

    public function __construct()
    {
        $this->patente = "/^[A-Z]{3} [0-9]{3}$/";
        $this->marca = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/";
        $this->modelo = "/^\d{4}$/";
        $this->nroDni = "/^\d{8}$/";
    }

    // Getters
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
    public function getDniDuenio()
    {
        return $this->nroDni;
    }

    // Setters
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
    public function setDniDuenio($dni)
    {
        $this->nroDni = $dni;
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
            $this->validarPatente($datos['patente']) 
            && $this->validarTexto($datos['marca']) 
            && $this->validarModelo($datos['modelo']) 
            && $this->validarDni($datos['dniDuenio']) 
        ) {
            $esValido = true;
        }
        return $esValido;
    }

    /**
     * Modulo correspondiente de validar si la patente es valida
     * @param string $patente
     * @return bool
     */
    private function validarPatente($patente)
    {
        $esValido = false;
        if (preg_match($this->getPatente(), $patente)) {
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
        if (preg_match($this->getMarca(), $texto)) {
            $esValido = true;
        }
        return $esValido;
    }

    /**
     * Modulo correspondiente de validar si el modelo es valido
     * @param int $modelo
     * @return bool
     */
    private function validarModelo($modelo)
    {
        $esValido = false;
        if (preg_match($this->getModelo(), $modelo)) {
            $esValido = true;
        }
        return $esValido;
    }

    /**
     * Modulo correspondiente de validar si el telefono es valido
     * @param int $telefono
     * @return bool
     */
    private function validarDni($dni)
    {
        $esValido = false;
        if (preg_match($this->getDniDuenio(), $dni)) {
            $esValido = true;
        }
        return $esValido;
    }

}
