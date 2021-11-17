<?php
/**
 * Classe que llama a los controladores, vistas y modelos
 */
    class Controllers{
        /**
         * Constructor que instancia la vista e invoca el método que llama al modelo
         */
        public function __construct(){
            $this->views = new Views();
            $this->loadModel();
        }

        /**
         * Métoddo que llama al modelo
         *
         * @return void
         */
        public function loadModel(){
            if(get_class($this) == "Login" || get_class($this) == "Usuario"){
                $model = "UserModel";
            } else{
                $model = get_class($this)."Model";
            }
            $routClass = "Models/" . $model . ".php";

            if(file_exists($routClass)){
                require_once($routClass);
                $this->model = new $model();
            }
        }
    }
?>