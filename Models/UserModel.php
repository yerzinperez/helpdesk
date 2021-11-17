<?php
/**
 * Clase para las acciones de un usuario
 * @property integer $intIdPersona
 * @property string $strIdentificacion
 * @property string $strNombres
 * @property string $strApellidos
 * @property string $strFechaNacimiento
 * @property string $strCargo
 * @property string $strCelular
 * @property string $strCelularAlternativo
 * @property string $strEmail
 * @property string $strDescripcion
 * @property integer $intIdUsuario
 * @property string $strUsuario
 * @property string $strPassword
 * @property integer $intRol
 * @property integer $intDepartamento
 * @property integer $intEstado
 * @property integer $intToken
 * @property string $strAvatar
 * @property string $strFechaCreacion
 * @property string $strFechaFechaActualizacion
 * @property string $strFechaFechaEliminacion
 */
    class UserModel extends Mysql{
        private $intIdPersona;
        private $strIdentificacion;
        private $strNombres;
        private $strApellidos;
        private $strFechaNacimiento;
        private $strCargo;
        private $strCelular;
        private $strCelularAlternativo;
        private $strEmail;
        private $strDescripcion;
        private $intIdUsuario;
        private $strUsuario;
        private $strPassword;
        private $intRol;
        private $intDepartamento;
        private $intEstado;
        private $intToken;
        private $strAvatar;
        private $strFechaCreacion;
        private $strFechaFechaActualizacion;
        private $strFechaFechaEliminacion;

        /**
         * Invoca el constructor de la conexión y la obtiene
         */
        public function __construct(){
            parent::__construct();
        }

        public function issetEmail(string $email){
            $this->strEmail = $email;

            try {
                $sql = "SELECT email FROM tbl_persona WHERE email = '{$this->strEmail}'";
                return $this->select($sql);
            } catch (\Throwable $th) {
                return 'error';
            }
        }

        /**
         * Método que consulta los datos de un usuario
         *
         * @param string $usuario Usuario a ser consultado
         * @param string $password Password del usuario a ser consultado
         * @return mixed Array de datos consultados o string (error) si ha habido un error
         */
        public function selectLogin(string $usuario, string $password){
            $this->strUsuario = $usuario;
            $this->strPassword = $password;
            try {
                $sql = "SELECT id_usuario, id_rol, estado FROM tbl_usuario WHERE
                    usuario = '{$this->strUsuario}' AND
                    contrasenia = '{$this->strPassword}'";
                    return $this->select($sql);
            } catch (\Throwable $th) {
                return 'error';
            }
        }

        /**
         * Método que obtiene toda la información del usuario
         *
         * @param integer $idUser ID del usuario a ser consultado
         * @return mixed Array con los datos consultados o string (error) si ha habido un error
         */
        public function sessionLogin(int $idUser){
            $this->intIdUser = $idUser;
            
            try {
                $sql = "SELECT tbl_usuario.id_usuario,
                            tbl_persona.id_persona,
                            tbl_persona.nombres,
                            tbl_persona.apellidos,
                            tbl_persona.email, 
                            tbl_persona.celular,
                            tbl_rol.id_rol,
                            tbl_rol.rol,
                            tbl_usuario.usuario,
                            tbl_usuario.estado,
                            tbl_departamento.id_departamento,
                            tbl_departamento.departamento
                    FROM tbl_usuario
                    INNER JOIN tbl_persona
                    ON tbl_persona.id_persona = tbl_usuario.id_persona
                    INNER JOIN tbl_rol
                    ON tbl_usuario.id_rol = tbl_rol.id_rol
                    INNER JOIN tbl_departamento
                    ON tbl_usuario.id_departamento = tbl_departamento.id_departamento
                    WHERE tbl_usuario.id_usuario = {$this->intIdUser}";
            
                    return $this->select($sql);
            } catch (\Throwable $th) {
                return 'error';
            }
        }

        /**
         * Método que obtiene todos los usuarios de la base de datos no eliminados
         *
         * @return mixed Array con la información de los usuarios o string con error
         */
        public function getUsuarios(){
            try {
                $sql = "SELECT 
                        tbl_usuario.id_usuario, 
                        CONCAT(tbl_persona.nombres, ' ', tbl_persona.apellidos) AS nombres, 
                        tbl_departamento.departamento,
                        tbl_rol.rol,
                        tbl_persona.email,
                        tbl_persona.celular,
                        tbl_usuario.estado
                    FROM tbl_usuario
                    INNER JOIN tbl_persona
                    ON tbl_persona.id_persona = tbl_usuario.id_persona
                    INNER JOIN tbl_departamento
                    ON tbl_departamento.id_departamento = tbl_usuario.id_departamento
                    INNER JOIN tbl_rol
                    ON tbl_rol.id_rol = tbl_usuario.id_rol
                    WHERE tbl_usuario.estado != '0'";
                return $this->selectAll($sql);
            } catch (\Throwable $th) {
                return 'error';
            }
        }

        /**
         * Obtiene la información de un usuario
         *
         * @param integer $idUsuario
         * @return mixed Array si hay datos o string si ha habido un error
         */
        public function getUsuario(int $idUsuario){
            $this->intIdUsuario = $idUsuario;

            try {
                $sql = "SELECT
                            tbl_usuario.id_usuario,
                            tbl_persona.identificacion,
                            CONCAT(tbl_persona.nombres, ' ', tbl_persona.apellidos) AS nombres_apellidos, 
                            tbl_persona.nombres,
                            tbl_persona.apellidos,
                            tbl_persona.fecha_nacimiento,
                            TIMESTAMPDIFF(YEAR, tbl_persona.fecha_nacimiento, CURRENT_TIMESTAMP) AS edad,
                            tbl_persona.cargo,
                            tbl_persona.celular,
                            tbl_persona.celular_alternativo,
                            tbl_persona.email,
                            tbl_rol.id_rol,
                            tbl_rol.rol,
                            tbl_departamento.id_departamento,
                            tbl_departamento.departamento,
                            tbl_usuario.usuario,
                            tbl_usuario.estado,
                            tbl_usuario.fecha_creacion,
                            tbl_usuario.fecha_actualizacion,
                            tbl_persona.descripcion
                        FROM tbl_usuario
                        INNER JOIN tbl_persona
                        ON tbl_persona.id_persona = tbl_usuario.id_persona
                        INNER JOIN tbl_departamento
                        ON tbl_departamento.id_departamento = tbl_usuario.id_departamento
                        INNER JOIN tbl_rol
                        ON tbl_rol.id_rol = tbl_usuario.id_rol
                        WHERE id_usuario = {$this->intIdUsuario}";
                return $this->select($sql);
            } catch (\Throwable $th) {
                return "error";
            }
        }

        /**
         * Método que crea un usuario
         *
         * @param string $identificacion
         * @param string $nombres
         * @param string $apellidos
         * @param string $fechaNacimiento
         * @param string $celular
         * @param string $celularAlternativo
         * @param string $correo
         * @param string $usuario
         * @param string $password
         * @param integer $estado
         * @param integer $rol
         * @param integer $departamento
         * @return mixed String con un error o number con id insertado
         */
        public function setUsuario(string $identificacion, string $nombres, string $apellidos, string $fechaNacimiento, string $cargo, string $celular, string $celularAlternativo, string $correo, string $usuario, string $password, int $estado, int $rol, int $departamento){
            $this->strIdentificacion = $identificacion;
            $this->strNombres = $nombres;
            $this->strApellidos = $apellidos;
            $this->strFechaNacimiento = $fechaNacimiento;
            $this->strCargo = $cargo;
            $this->strCelular = $celular;
            $this->strCelularAlternativo = $celularAlternativo == '' ? null : $celularAlternativo;
            $this->strEmail = $correo;
            $this->strUsuario = $usuario;
            $this->strPassword = $password;
            $this->intEstado = $estado;
            $this->intRol = $rol;
            $this->intDepartamento = $departamento;

            try {
                //se valida si ya exite un usuario con el mismo numero de identificación y email
                $sql = "SELECT id_persona, identificacion, email FROM tbl_persona WHERE identificacion = '{$this->strIdentificacion}' OR email = '{$this->strEmail}'";
                $requestSelect = $this->selectAll($sql);

                if(empty($requestSelect)){
                    //si no existe
                    $sql = "INSERT INTO tbl_persona VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, NULL)";
                    $arrData = array(
                        $this->strIdentificacion,
                        $this->strNombres,
                        $this->strApellidos,
                        $this->strFechaNacimiento,
                        $this->strCargo,
                        $this->strCelular,
                        $this->strCelularAlternativo,
                        $this->strEmail
                    );

                    $this->intIdPersona = $this->insert($sql, $arrData);
                    
                    $sql = "INSERT INTO tbl_usuario(id_usuario, id_persona, usuario, contrasenia, id_rol, id_departamento, estado) VALUES(NULL, ?, ?, ?, ?, ?, ?)";
                    $arrData = array(
                        $this->intIdPersona,
                        $this->strUsuario,
                        $this->strPassword,
                        $this->intRol,
                        $this->intDepartamento,
                        $this->intEstado
                    );

                    return array('existe' => false, 'error' => false, 'data' => $this->insert($sql, $arrData));
                } else{
                    return array('existe' => true, 'error' => false, 'data' => $requestSelect);
                }
            } catch (\Throwable $th) {
                return array('error' => true);
            }
        }

        /**
         * Método para actualizar un usuario
         *
         * @param integer $idUsuario
         * @param string $identificacion
         * @param string $nombres
         * @param string $apellidos
         * @param string $fechaNacimiento
         * @param string $cargo
         * @param string $celular
         * @param string $celularAlternativo
         * @param string $correo
         * @param string $usuario
         * @param string $password
         * @param integer $estado
         * @param integer $rol
         * @param integer $departamento
         * @return mixed Number 1 si se actualizó, 0 si no. String si hubo un error.
         */
        public function updateUsuario(int $idUsuario, string $identificacion, string $nombres, string $apellidos, string $fechaNacimiento, string $cargo, string $celular, string $celularAlternativo, string $correo, string $usuario, string $password, int $estado, int $rol, int $departamento){
            $this->intIdUsuario = $idUsuario;
            $this->strIdentificacion = $identificacion;
            $this->strNombres = $nombres;
            $this->strApellidos = $apellidos;
            $this->strFechaNacimiento = $fechaNacimiento;
            $this->strCargo = $cargo;
            $this->strCelular = $celular;
            $this->strCelularAlternativo = $celularAlternativo == '' ? null : $celularAlternativo;
            $this->strEmail = $correo;
            $this->strUsuario = $usuario;
            $this->strPassword = $password;
            $this->intEstado = $estado;
            $this->intRol = $rol;
            $this->intDepartamento = $departamento;

            try {
                $sql = "UPDATE tbl_persona SET identificacion = ?, nombres = ?, apellidos = ?, fecha_nacimiento = ?, cargo = ?, celular = ?, celular_alternativo = ?, email = ? WHERE id_persona = ?";
                $arrData = array(
                    $this->strIdentificacion,
                    $this->strNombres,
                    $this->strApellidos,
                    $this->strFechaNacimiento,
                    $this->strCargo,
                    $this->strCelular,
                    $this->strCelularAlternativo,
                    $this->strEmail,
                    $this->intIdUsuario,
                );
                $this->update($sql, $arrData);

                if ($this->strPassword == '') {
                    $sql = "UPDATE tbl_usuario SET usuario = ?, id_rol = ?, id_departamento = ?, estado = ?, fecha_actualizacion = CURRENT_TIMESTAMP WHERE id_usuario = ?";
                    $arrData = array(
                        $this->strUsuario,
                        $this->intRol,
                        $this->intDepartamento,
                        $this->intEstado,
                        $this->intIdUsuario
                    );
                } else {
                    $sql = "UPDATE tbl_usuario SET usuario = ?, contrasenia = ?, id_rol = ?, id_departamento = ?, estado = ?, fecha_actualizacion = CURRENT_TIMESTAMP WHERE id_usuario = ?";
                    $arrData = array(
                        $this->strUsuario,
                        $this->strPassword,
                        $this->intRol,
                        $this->intDepartamento,
                        $this->intEstado,
                        $this->intIdUsuario
                    );
                }
                
                return array('error' => false, 'data' => $this->update($sql, $arrData));
            } catch (\Throwable $th) {
                return array('error' => true);
            }
        }

        /**
         * Método que elimina un usuario de la base de datos
         *
         * @param integer $idUsuario
         * @return bool True si se ha actualizado, False si no se ha podido consultar
         */
        public function deleteUsuario(int $idUsuario){
            $this->intidUsuario = $idUsuario;

            try {
                $sql = "UPDATE tbl_usuario SET estado = ?, fecha_actualizacion = CURRENT_TIMESTAMP, fecha_eliminacion = CURRENT_TIMESTAMP WHERE id_usuario = ?";
                $arrData = array(0, $this->intidUsuario);
                return $this->update($sql, $arrData);
            } catch (\Throwable $th) {
                return 'error';
            }
        }

        /**
         * Método que restaura un usuario de la base de datos
         *
         * @param integer $idUsuario
         * @return mixed True si se ha actualizado, False si no se ha podido consultar o error (string)
         */
        public function restaurarUsuario(int $idUsuario){
            $this->intidUsuario = $idUsuario;

            try {
                $sql = "UPDATE tbl_usuario SET estado = ?, fecha_actualizacion = CURRENT_TIMESTAMP,fecha_eliminacion = NULL WHERE id_usuario = ?";
                $arrData = array(2, $this->intidUsuario);
                return $this->update($sql, $arrData);
            } catch (\Throwable $th) {
                return 'error';
            }
        }

        /**
         * Destructor que vacia las variables
         */
        public function __destruct(){
            unset($intIdPersona);
            unset($strIdentificacion);
            unset($strNombres);
            unset($strApellidos);
            unset($strFechaNacimiento);
            unset($strCargo);
            unset($strCelular);
            unset($strCelularAlternativo);
            unset($strEmail);
            unset($strDescripcion);
            unset($intIdUsuario);
            unset($strUsuario);
            unset($strPassword);
            unset($intRol);
            unset($intDepartamento);
            unset($intEstado);
            unset($intToken);
            unset($strAvatar);
            unset($strFechaCreacion);
            unset($strFechaFechaActualizacion);
            unset($strFechaFechaEliminacion);
        }
    }
?>