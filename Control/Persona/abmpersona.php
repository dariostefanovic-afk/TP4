<?php
include_once('../../modelo/persona.php');
include_once('validadorpersona.php');

class AbmPersona
{

    /**
     * Modulo Buscar
     * Busca registros en la base de datos según los parámetros recibidos.
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['nroDni'])) {
                $where .= " and nroDni = " . $param['nroDni'];
            }
            if (isset($param['nombre'])) {
                $where .= " and nombre = '" . $param['nombre'] . "'";
            }
            if (isset($param['apellido'])) {
                $where .= " and apellido = '" . $param['apellido'] . "'";
            }
            if (isset($param['fechaNac'])) {
                $where .= " and fechaNac = '" . $param['fechaNac'] . "'";
            }
            if (isset($param['telefono'])) {
                $where .= " and telefono = '" . $param['telefono'] . "'";
            }
            if (isset($param['domicilio'])) {
                $where .= " and domicilio = '" . $param['domicilio'] . "'";
            }
        }
        $arreglo = Persona::seleccionar($where);
        return $arreglo;
    }

    /**
     * Cargar el objeto
     * Instancia un objeto Persona y le setea los valores correspondientes.
     * @param array $param
     * @return Persona|null
     */
    private function cargarObjeto($param)
    {
        $objPersona = null;
        // Verificamos que vengan todos los campos necesarios
        if (
            array_key_exists('nroDni', $param) &&
            array_key_exists('apellido', $param) &&
            array_key_exists('nombre', $param) &&
            array_key_exists('fechaNac', $param) &&
            array_key_exists('telefono', $param) &&
            array_key_exists('domicilio', $param)
        ) {
            $objPersona = new Persona();
            $objPersona->setear(
                $param['nroDni'],
                $param['apellido'],
                $param['nombre'],
                $param['fechaNac'],
                $param['telefono'],
                $param['domicilio']
            );
        }
        return $objPersona;
    }

    /**
     * Corrobora que dentro del array asociativo está seteada la clave primaria
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['nroDni'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Cargar un objeto solo con la clave primaria
     * Útil para operaciones como Baja, donde solo necesitamos el identificador.
     * @param array $param
     * @return Usuario|null
     */
    private function cargarObjetoConClave($param)
    {
        $objPersona = null;
        if (isset($param['nroDni'])) {
            $objPersona = new Persona();
            $objPersona->setear($param['nroDni'], null, null, null, null, null);
        }
        return $objPersona;
    }

    /**
     * Módulo Alta
     * Inserta un nuevo usuario si el nroDni no existe previamente.
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;

        // Evitamos duplicados buscando si ya existe el DNI
        $existePersona = $this->buscar(["nroDni" => $param['nroDni']]);

        // Si el arreglo está vacío (no existe), procedemos a insertar
        if (empty($existePersona)) {
            $objPersona = $this->cargarObjeto($param);
            if ($objPersona != null && $objPersona->insertar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Módulo Modificación
     * Modifica un registro existente en la base de datos.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;

        // Verificamos que venga la clave principal y luego cargamos todos los datos
        if ($this->seteadosCamposClaves($param)) {
            $objPersona = $this->cargarObjeto($param);
            if ($objPersona != null && $objPersona->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Módulo Baja
     * Elimina definitivamente el registro (Baja física).
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objPersona = $this->cargarObjetoConClave($param);
            if ($objPersona != null && $objPersona->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Módulo validacionAlta
     * Encargado de juntar la validacion + el alta.
     * @param array $param
     * @return boolean
     */
    public function validacionAlta($param)
    {
        $esValido = false;
        $objValidador = new ValidadorPersona();
        if ($objValidador->validarDatos($param)) {
            if ($this->alta($param)) {
                $esValido = true;
            }
        }
        return $esValido;
    }

    /**
     * Módulo validacionModificacion
     * Encargado de juntar la validacion + la modificacion.
     * @param array $param
     * @return boolean
     */
    public function validacionModificacion($param)
    {
        $esValido = false;
        $objValidador = new ValidadorPersona();
        if ($objValidador->validarDatos($param)) {
            if ($this->modificacion($param)) {
                $esValido = true;
            }
        }
        return $esValido;
    }
}
