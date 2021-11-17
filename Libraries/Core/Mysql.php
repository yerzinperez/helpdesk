<?php
/**
 * Clase que tiene los métodos del CRUD para MySQL
 * @property PDO $conexion Conexión a MySQL
 * @property string $strQuery Cadena de consulta SQL
 * @property array $arrValues Array con los valores de consulta
 */
    class Mysql extends Conexion{
        private $conexion;
        private $strQuery;
        private $arrValues;

        /**
         * Constructor  que llama la conexión
         */
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->connect();
        }

        /**
         * Método que inserta registros en la base de datos
         *
         * @param string $query Consulta sql
         * @param array $arrValues Array con los valores a insertar
         * @return int ID del registro insertado
         */
        public function insert(string $query, array $arrValues){
            $this->strQuery = $query;
            $this->arrValues = $arrValues;

            $insert = $this->conexion->prepare($this->strQuery);
            $resInsert = $insert->execute($this->arrValues);

            if ($resInsert) {
                $lastInsert = $this->conexion->lastInsertId();
            } else {
                $lastInsert = 0;
            }
            return $lastInsert;
        }

        /**
         * Método que consulta un registro en la base de datos
         *
         * @param string $query Consulta sql
         * @return array Array de datos
         */
        public function select(string $query){
            $this->strQuery = $query;
            $result = $this->conexion->prepare($this->strQuery);
            $result->execute();
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        /**
         * Método que que consulta varios registros
         *
         * @param string $query Consulta sql
         * @return array Array de datos
         */
        public function selectAll(string $query){
            $this->strQuery = $query;
            $result = $this->conexion->prepare($this->strQuery);
            $result->execute();
            $data = $result->fetchall(PDO::FETCH_ASSOC);
            return $data;
        }

        /**
         * Método que actualiza un registro
         *
         * @param string $query Consulta sql
         * @param array $arrValues Array con los datos a actualizar
         * @return bool
         */
        public function update(string $query, array $arrValues){
            $this->strQuery = $query;
            $this->arrValues = $arrValues;

            $update = $this->conexion->prepare($this->strQuery);
            $resExecute = $update->execute($this->arrValues);

            return $resExecute;
        }

        /**
         * Método que eliminar un registro
         *
         * @param string $query Consulta sql
         * @return boolean
         */
        public function delete(string $query){
            $this->strQuery = $query;
            $result = $this->conexion->prepare($this->strQuery);
            $del = $result->execute();
            return $del;
        }

        /**
         * Destructor que vacia las variables
         */
        public function __destruct(){
            unset($conexion);
            unset($strQuery);
            unset($arrValues);
        }
    }
?>