<?php

    /**
     * Clase que contiene los métodos para el dashboard
     */
    class Usuario extends Controllers{

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
        public function usuarios(){
            $data['page_title'] = "Usuarios";
            $data['page_functions'] = media() . "js/usuarios/usuarios.js";
            $this->views->getView($this, "usuarios", $data);
        }

        /**
         * Método que obtiene los roles de usuario
         *
         * @return json Array de datos
         */
        public function getRoles(){
            if($_GET){
                include_once("Models/Roles.php");
                $roles = new RolesModel();
                $arrResponse = $roles->getAllRoles();

                if($arrResponse != 'error'){
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                }
            }
        }

        /**
         * Método que obtiene los departamentos de usuarios
         *
         * @return json Array de datos
         */
        public function getDepartamentos(){
            if($_GET){
                include_once("Models/Departamentos.php");
                $roles = new DepartamentoModel();
                $arrResponse = $roles->getAllDepartamentos();

                if($arrResponse != 'error'){
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                }
            }
        }

        /**
         * Método que obtiene los usuarios
         *
         * @return json Array de datos
         */
        public function getUsuarios(){
            $arrResponse = $this->model->getUsuarios();

            if($arrResponse != 'error'){
                for ($i=0; $i < count($arrResponse); $i++) { 
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';
    
                    if($arrResponse[$i]['estado'] == 1){
                        $arrResponse[$i]['estado'] = '<span class="label label-success">Activo</span>';
                    } else{
                        $arrResponse[$i]['estado'] = '<span class="label label-danger">Inactivo</span>';
                    }

                    if($arrResponse[$i]['email']){
                        $arrResponse[$i]['email'] = '<a href="mailto:'.$arrResponse[$i]['email'].'">'.$arrResponse[$i]['email'].'</a>';
                    }
                    if($arrResponse[$i]['celular']){
                        $arrResponse[$i]['celular'] = '<a href="tel:'.$arrResponse[$i]['celular'].'">'.$arrResponse[$i]['celular'].'</a>';
                    }
    
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewUsuario(' . $arrResponse[$i]['id_usuario'] . ')" title="Ver"><i class="fas fa-eye"></i></button>';
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditarUsuario(' . $arrResponse[$i]['id_usuario'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntEliminarUsuario(' . $arrResponse[$i]['id_usuario'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                    $arrResponse[$i]['acciones'] = '<div class="text-center">' . $btnView . ' '. $btnEdit . ' ' . $btnDelete . '</div>';
                }
            }else {
                $arrResponse = array('status' => false, 'msg' => 'Datos inválidos.');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        /**
         * Método para obtener un usuario
         *
         * @param int $idUsuario ID del isuario
         * @return json Array de datos que comprende un estado de la consulta y el mensaje.
         */
        public function getUsuario(int $idUsuario){
            $idUsuario = intval(strClean($idUsuario));

            $arrData = $this->model->getUsuario($idUsuario);

            if ($arrData != "error") {
                $arrResponse = array('status' => true, 'msg' => $arrData);
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No se ha podido hacer la operación.');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        /**
         * Método para agregar un usuario
         *
         * @return json Array de datos que comprende un estado de la consulta y el mensaje.
         */
        public function setUsuario(){
            if($_POST){
                if(!empty($_POST['txtIdentificacion']) || !empty($_POST['txtNombres']) || !empty($_POST['txtApellidos']) || !empty($_POST['txtFechaNacimiento']) || !empty($_POST['txtCargo']) || !empty($_POST['txtCelular']) || !empty($_POST['txtCorreo']) || !empty($_POST['txtUsuario']) || !empty($_POST['txtPassword']) || !empty($_POST['cboEstado']) || !empty($_POST['cboRol']) || !empty($_POST['cboDepartamento'])){
                    $intIdUsuario = intval(strClean($_POST['idUsuario']));
                    $intIdentificacion = strClean($_POST['txtIdentificacion']);
                    $strNombres = ucwords(strClean($_POST['txtNombres']));
                    $strApellidos = ucwords(strClean($_POST['txtApellidos']));
                    $strFechaNacimiento = strClean($_POST['txtFechaNacimiento']);
                    $strCargo = ucwords(strClean($_POST['txtCargo']));
                    $strCelular = strClean($_POST['txtCelular']);
                    $strCelularAlternativo = strClean($_POST['txtCelularAlternativo']);
                    $strCorreo = validarEmail(strClean($_POST['txtCorreo']));
                    $strUsuario = validarEmail(strClean($_POST['txtUsuario']));
                    $strPassword = strClean($_POST['txtPassword']);
                    $intEstado = intval(strClean($_POST['cboEstado']));
                    $intRol = intval(strClean($_POST['cboRol']));
                    $intDepartamento = intval(strClean($_POST['cboDepartamento']));

                    if($strCorreo && $strUsuario){
                        if ($intIdUsuario == 0) {
                            $opcion = 0;//agregar
                            $strPassword = hash('sha256', $strPassword);
                            $arrData = $this->model->setUsuario($intIdentificacion, $strNombres, $strApellidos, $strFechaNacimiento, $strCargo, $strCelular, $strCelularAlternativo, $strCorreo, $strUsuario, $strPassword, $intEstado, $intRol, $intDepartamento);
                        } else {
                            $opcion = 1;//actualizar
                            $strPassword = $strPassword == '' ? '' : hash('sha256', $strPassword);
                            $arrData = $this->model->updateUsuario($intIdUsuario,$intIdentificacion, $strNombres, $strApellidos, $strFechaNacimiento, $strCargo, $strCelular, $strCelularAlternativo, $strCorreo, $strUsuario, $strPassword, $intEstado, $intRol, $intDepartamento);
                        }
                        if(!empty($arrData)){
                            if($arrData['error'] != 1 || $arrData['data'] == 1){
                                if ($opcion == 0) {
                                    if ($arrData['existe'] != 1) {
                                        $arrResponse = array('status' => true, 'msg' => 'El usuario se ha agregado correctamente.');
                                    } else {
                                        $arrResponse = array('status' => false, 'msg' => '¡La identificación o el email ya existen! ¿Desea restaurar el usuario?', 'code' => 1, 'data' => $arrData['data'][0]['id_persona']);
                                    }
                                } else {
                                    $arrResponse = array('status' => true, 'msg' => 'El usuario se ha actualizado correctamente.');
                                }
                            } else {
                                $arrResponse = array('status' => false, 'msg' => 'No se ha podido hacer la operación. Por favor, inténtelo de nuevo. ');
                            }
                        } else {
                            $arrResponse = array('status' => false, 'msg' => 'No se ha podido hacer la operación. Por favor, inténtelo de nuevo. empty ');
                        }
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'Email y/o usuario inválido.');
                    }
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Datos inválidos.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        /**
         * Método para eliminar un usuario
         *
         * @param int $idUsuario ID del usuario
         * @return json Array de datos que comprende un estado de la consulta y el mensaje.
         */
        public function delUsuario($idUsuario){
            $idUsuario = intval(strClean($idUsuario));

            $arrData = $this->model->deleteUsuario($idUsuario);

            if(!empty($arrData)){
                if($arrData !== 'error'){
                    $arrResponse = array('status' => true, 'msg' => 'Usuario eliminado con éxito.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Hubo un error al eliminar el usuario.');
                }
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No se ha podido eliminar el usuario.');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        /**
         * Método para restaurar un usuario
         *
         * @param int $idUsuario ID del usuario
         * @return json Array de datos que comprende un estado de la consulta y el mensaje.
         */
        public function restaurarUsuario($idUsuario){
            $idUsuario = intval(strClean($idUsuario));

            $arrData = $this->model->restaurarUsuario($idUsuario);

            if(!empty($arrData)){
                if($arrData !== 'error'){
                    $arrResponse = array('status' => true, 'msg' => 'Usuario restaurado con éxito. El usuario se actualizó en un estado inactivo.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Hubo un error al restaurar el usuario.');
                }
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No se ha podido restaurar el usuario.');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>