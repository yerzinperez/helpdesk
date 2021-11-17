<?php
    class RolesModel extends Mysql{
        private $intidRol;
        private $strNombre;
        private $strDescripcion;
        private $intEstado;

        /**
         * Constructor que invoca la conexión
         */
        public function __construct(){
            parent::__construct();
        }

        /**
         * Método que obtiene todos los roles de la base de datos
         *
         * @return array Array con los datos consultados
         */
        public function getAllRoles(){
            try {
                $sql = "SELECT id_rol, rol FROM tbl_rol";
                return $this->selectAll($sql);
            } catch (\Throwable $th) {
                return 'error';
            }
        }

        /**
         * Método que obtiene los roles activos de la base de datos
         *
         * @return array Array con los datos consultados
         */
        public function getRolesActivos(){
            try {
                $sql = "SELECT * FROM tbl_rol WHERE estado = 1";
                return $this->selectAll($sql);
            } catch (\Throwable $th) {
                return 'error';
            }
        }

        /**
         * Método que obtiene un rol de la base de datos
         *
         * @param integer $idRol ID del rol
         * @return array Array con los datos consultados
         */
        public function getRol(int $idRol){
            $this->intIdrol = $idRol;

            try {
                $sql = "SELECT * FROM tbl_rol WHERE id_rol = {$this->intIdrol}";
                return $this->select($sql);
            } catch (\Throwable $th) {
                return "error";
            }
        }

        /**
         * Destructor que vacía las variables
         */
        public function __destruct(){
            unset($intidRol);
            unset($strNombre);
            unset($strDescripcion);
            unset($intEstado);
        }
    }
?>