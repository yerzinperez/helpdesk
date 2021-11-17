<?php

    /**
     * Clase que contiene los métodos para el dashboard
     */
    class Dashboard extends Controllers{

        /**
         * Constructor que carga la vista y llama al modelo
         */
        public function __construct(){
            parent::__construct();
            session_start();

            if(!isset($_SESSION['login'])){
                header('location: ' . base_url());
            }
        }

        /**
         * Método que llama la vista de dashboard
         *
         * @return void
         */
        public function dashboard(){
            $data['page_title'] = "Home";
            $data['page_functions'] = media() . "js/dashboard/dashboard.js";
            $this->views->getView($this, "dashboard", $data);
        }

    }
?>