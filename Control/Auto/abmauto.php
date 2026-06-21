<?php
include_once('../../modelo/auto.php');
include_once('../../modelo/persona.php');
//include_once '../persona/abmpersona.php';
include_once('validadorauto.php');
include_once '../../util/funciones.php';

class AbmAuto
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
            if (isset($param['patente'])) {
                $where .= " and patente = '" . $param['patente'] . "'";
            }
            if (isset($param['marca'])) {
                $where .= " and marca = '" . $param['marca'] . "'";
            }
            if (isset($param['modelo'])) {
                $where .= " and modelo = " . $param['modelo'];
            }
            if (isset($param['dniDuenio'])) {
                $where .= " and dniDuenio = '" . $param['dniDuenio'] . "'";
            }
        }
        $arreglo = Auto::seleccionar($where);
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
        $objAuto = null;
        // Verificamos que vengan todos los campos necesarios
        if (
            array_key_exists('patente', $param) &&
            array_key_exists('marca', $param) &&
            array_key_exists('modelo', $param) &&
            array_key_exists('dniDuenio', $param) 
        ) {
            $objAuto = new Auto();
            $abmPersona = new AbmPersona();
            $dni = $param["dniDuenio"];
            $arDuenio = $abmPersona->buscar(["nroDni" => $dni]);
            $objAuto->setear(
                $param['patente'],
                $param['marca'],
                $param['modelo'],
                $arDuenio[0]
            );
        }
        return $objAuto;
    }

    /**
     * Corrobora que dentro del array asociativo está seteada la clave primaria
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['patente'])) {
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
        $objAuto = null;
        if (isset($param['patente'])) {
            $objAuto = new Auto();
            $objAuto->setear($param['patente'], null, null, null);
        }
        return $objAuto;
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

        // Evitamos duplicados buscando si ya existe la patente
        $existeAuto = $this->buscar(["patente" => $param['patente']]);

        // Si el arreglo está vacío (no existe), procedemos a insertar
        if (empty($existeAuto)) {
            $objAuto = $this->cargarObjeto($param);
            if ($objAuto != null && $objAuto->insertar()) {
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
            $objAuto = $this->cargarObjeto($param);
            if ($objAuto != null && $objAuto->modificar()) {
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
            $objAuto = $this->cargarObjetoConClave($param);
            if ($objAuto != null && $objAuto->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function validacionDatos($param)
    {
        $esValido = false;
        $objValidador = new ValidadorAuto();
        if ($objValidador->validarDatos($param)) {
                $esValido = true;
        }
        return $esValido;
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
        $objValidador = new ValidadorAuto();
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
        $objValidador = new ValidadorAuto();
        if ($objValidador->validarDatos($param)) {
            if ($this->modificacion($param)) {
                $esValido = true;
            }
        }
        return $esValido;
    }
}
