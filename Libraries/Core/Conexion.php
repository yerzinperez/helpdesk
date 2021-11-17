<?php
/**
 * Clase para la conexión a la base de datos
 * @property mixed $connect Conexión a MySQL
 */
    class Conexion{
        private $connect;

        /**
         * Constructor que hace la conexión
         */
        public function __construct(){
            $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_CHARSET;
            try{
                $this->connect = new PDO($connectionString, DB_USER, DB_PASSWORD);
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //La conexion fue exitosa
            }catch(PDOException $e){
                $this->connect = "Error de conexión a la base de datos. Informar al administrador";
                $GLOBALS["ERROR_USER"] = "ERROR: " . $this->connect;
                $GLOBALS["ERROR_ADMIN"] = "ERROR: " . $e->getMessage();
                require("Controllers/Error.php");
            }
        }

        /**
         * Método que retorna la conexión
         *
         * @return mixed $connect Conexión a MySQL o error de conexión.
         */
        public function connect(){
            return $this->connect;
        }

        /**
         * Destructor que vacia las variables
         */
        public function __destruct(){
            unset($connect);
        }
    }
?>