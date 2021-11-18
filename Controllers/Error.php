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
            $data['page_title'] = "Error";
            $this->views->getView($this, "error", $data);
        }
    }

    $notFound = new Errors();
    $notFound->notFound();
?>