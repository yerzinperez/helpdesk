<?php

    /**
     * Clase que contiene los métodos para el login de usuario
     */
    class Login extends Controllers{

        /**
         * Constructor que carga la vista y llama al modelo
         */
        public function __construct(){
            parent::__construct();
            session_start();

            if(isset($_SESSION['login'])){
                header('location: ' . base_url() . 'dashboard');
            }
        }

        /**
         * Método que llama la vista de login
         *
         * @return void
         */
        public function login(){
            $data['page_title'] = "Log in";
            $data['page_functions'] = media() . "js/login/login.js";
            $this->views->getView($this, "login", $data);
        }

        /**
         * Método para loguear un usuario
         *
         * @return void
         */
        public function loginUser(){
            if ($_POST) {
                if(!empty($_POST['userEmail']) || !empty($_POST['userPassword']) || validarEmail($_POST['userEmail']) != false){
                    $usuario = strClean($_POST['userEmail']);
                    $password = hash('sha256', strClean($_POST['userPassword']));
                    
                    $issetEmail = $this->model->issetEmail($usuario);
                    
                    if(!empty($issetEmail) && $issetEmail != 'error'){
                        $arrRequestLogin = $this->model->selectLogin($usuario, $password);
                        if(!empty($arrRequestLogin) && $arrRequestLogin != 'error'){
                            if($arrRequestLogin['estado'] == 1){
                                $_SESSION['idUser'] = $arrRequestLogin['id_usuario'];
                                $_SESSION['login'] = true;
    
                                $arrData = $this->model->sessionLogin($_SESSION['idUser']);
                                if ($arrData != 'error') {
                                    $_SESSION['userData'] = $arrData;
                                    
                                    $arrResponse = array('status' => true, 'msg' => 'ok');
                                } else {
                                    session_unset();
                                    session_destroy();
                                    $arrResponse = array('status' => false, 'msg' => 'Hubo un error. Contacte al administrador.');
                                }
                                
                            } else{
                                $arrResponse = array('status' => false, 'msg' => 'El usuario no está activo. Contacte al administrador.');
                            }
                        } else{
                            $arrResponse = array('status' => false, 'msg' => 'El usuario y la contraseña no coinciden.');
                        }
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'El usuario no existe.');
                    }
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Datos inválidos.');
                }
    
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
    }
?>