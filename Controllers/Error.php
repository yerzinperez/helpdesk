<?php 
    /**
     * Clase que llama la vista de errores
     */
    class Errors extends Controllers{
        /**
         * Constructor que carga la vista
         */
        public function __construct(){
            parent::__construct();
        }

        /**
         * Método que muestra la vista
         *
         * @return void
         */
        public function notFound(){
            $this->views->getView($this, "error");
        }
    }

    $notFound = new Errors();
    $notFound->notFound();
?>