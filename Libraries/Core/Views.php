<?php
    class Views{

        /**
         * Método que carga las vistas
         *
         * @param object $controller Nombre del archivo de la clase controlador
         * @param string $view Nombre del archivo de la vista
         * @param array $data Datos que deben ser llevados a la vista
         * @return void
         */
        function getView($controller, $view, $data=""){
            $controller = get_class($controller);
            if($controller == 'Ticket'){
                $view = "Views/Tickets/" . $view . ".php";
            } else {
                $view = "Views/" . $controller . "/" . $view . ".php";
            }
            require_once($view);
        }
    }
?>