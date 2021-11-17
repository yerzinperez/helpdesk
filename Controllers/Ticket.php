<?php

    /**
     * Clase que contiene los métodos para el dashboard
     */
    class Ticket extends Controllers{

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
         * Método que llama la vista de login
         *
         * @return void
         */
        public function tickets(){
            $data['page_title'] = "Tickets";
            $data['page_functions'] = media() . "js/tickets/tickets.js";
            $this->views->getView($this, "tickets", $data);
        }

        /**
         * Método que obtiene los usuarios
         *
         * @return json Array de datos
         */
        public function getTickedsAbiertos(){
            $arrData = $this->model->getUsuarios();

            for ($i=0; $i < count($arrData); $i++) { 
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                if($arrData[$i]['estado'] == 1){
                    $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                } else{
                    $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                if($_SESSION['permisosModulo']['leer']){
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Ver"><i class="fas fa-eye"></i></button>';
                }
                if($_SESSION['permisosModulo']['actualizar']){
                    if(($_SESSION['idUser'] == 1 && $_SESSION['userData']['id_rol'] == 1) || ($_SESSION['userData']['id_rol'] == 1 && $arrData[$i]['id_rol'] != 1)){
                        $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditarUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                    } else {
                        $btnEdit = '<button class="btn btn-secondary btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>';
                    }
                }
                if($_SESSION['permisosModulo']['eliminar']){
                    if(($_SESSION['idUser'] == 1 && $_SESSION['userData']['id_rol'] == 1) ||
                    ($_SESSION['userData']['id_rol'] == 1 && $arrData[$i]['id_rol'] != 1) &&
                    ($_SESSION['userData']['id_usuario'] != $arrData[$i]['id_usuario'])){
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntEliminarUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                    } else {
                        $btnDelete = '<button class="btn btn-secondary btn-sm" disabled><i class="far fa-trash-alt"></i></button>';
                    }
                }

                $arrData[$i]['opciones'] = '<div class="text-center">' . $btnView . ' '. $btnEdit . ' ' . $btnDelete . '</div>';
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

    }
?>