<?php
/**
     * Función que retorna la url raiz del proyecto
     * @return string URL raiz del proyecto
     */
    function base_url(){
        return BASE_URL;
    }

    /**
     * Función que retorna la url de los archivos multimedia
     *
     * @return string URL de los archivos multimedia
     */
    function media(){
        return BASE_URL . "Assets/";
    }

    /**
     * Función que llama al header del sistema
     *
     * @param array $data Array de datos dados por el controlador
     * @return void
     */
    function headerDashboard(array $data){
        $view_header = "Views/Template/header.php";
        require_once($view_header);
    }

    /**
     * Función que llama al footer del sistema
     *
     * @param array $data Array de datos dados por el controlador
     * @return void
     */
    function footerDashboard(array $data){
        $view_footer = "Views/Template/footer.php";
        require_once($view_footer);
    }

    /**
     * Función que llama al modal
     *
     * @param string $nameModal Nombre del modal a ser llamado
     * @param array $data Array de datos dados por el controlador o la vista
     * @return void
     */
    function getModal(string $nameModal, array $data){
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once($view_modal);
    }

    /**
     * Función para depurar código
     *
     * @param array $data Array de datos
     * @return string Datos en formato HTML
     */
    function dep($data){
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('<pre>');
        return $format;
    }

    /**
     * Función para enviar emails
     *
     * @param array $data Array de datos
     * @param string $template Nombre del archivo plantilla para el email
     * @return bool True si se ha enviado. False si no se ha enviado
     */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    function sendEmail(array $data, string $template){
        include("./Libraries/phpmailer/PHPMailer.php");
        include("./Libraries/phpmailer/SMTP.php");
        include("./Libraries/phpmailer/Exception.php");

        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        $mensaje = ob_get_clean();

        try {
            $emailTo = $data['email'];
            $subject =  $data['asuntoEmail'];

            $fromEmail = EMAIL_REMITENTE;
            $fromName = NOMBRE_REMITENTE;

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = "mail.gestionefectivasas.com";
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Username = $fromEmail;
            $mail->Password = "{Yi5u=4z?n}A";
            $mail->CharSet = 'UTF-8';

            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($emailTo);

            //asunto
            $mail->isHTML(true);
            $mail->Subject = $subject;

            //mensaje
            $mail->Body = $mensaje;

            if (!$mail->send()) {
                $request = false;
            } else {
                $request = true;
            }
        } catch (Exception $e) {
            $request = false;
        }
        return $request;
    }


    /**
     * Función para limpiar cadenas
     *
     * @param string $strCadena Cadena a ser limpiada
     * @return string Cadena limpia
     */
    function strClean($strCadena){
        $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
        $string = trim($string);//elimina espacio al final y al principio
        $string = stripslashes($string); //elimina los \ invertidas
        $string = str_ireplace("<script>", "", $string);
        $string = str_ireplace("</script>", "", $string);
        $string = str_ireplace("</script src>", "", $string);
        $string = str_ireplace("</script type=>", "", $string);
        $string = str_ireplace("SELECT * FROM", "", $string);
        $string = str_ireplace("DELETE FROM", "", $string);
        $string = str_ireplace("INSERT INTO", "", $string);
        $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
        $string = str_ireplace("DROP TABLE", "", $string);
        $string = str_ireplace("OR '1'='1'", "", $string);
        $string = str_ireplace('OR "1"="1"', "", $string);
        $string = str_ireplace('OR ´1´=´1´', "", $string);
        $string = str_ireplace("is NULL; --", "", $string);
        $string = str_ireplace("is NULL; --", "", $string);
        $string = str_ireplace("LIKE '", "", $string);
        $string = str_ireplace('LIKE "', "", $string);
        $string = str_ireplace('LIKE ´', "", $string);
        $string = str_ireplace("OR 'a' = 'a'", "", $string);
        $string = str_ireplace('OR "a" = "a"', "", $string);
        $string = str_ireplace("OR ´a´ = ´a´", "", $string);
        $string = str_ireplace("OR ´a´ = ´a´", "", $string);
        $string = str_ireplace("--", "", $string);
        $string = str_ireplace("^", "", $string);
        $string = str_ireplace("[", "", $string);
        $string = str_ireplace("]", "", $string);
        $string = str_ireplace("==", "", $string);
        return $string;
    }

    /**
     * Función para validar emails
     *
     * @param string $email Email a ser validado
     * @return mixed Retorna el email si es válido o retorna false si no lo es
     */
    function validarEmail(string $email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else {
            return false;
        }
    }

    /**
     * Función para generar una contraseña aleatoria de 10 caracteres
     *
     * @param integer $length Longitud de la contraseña (opcional)
     * @return string Contraseña generada
     */
    function passGenerator($length = 10){
        $pass = "";
        $longitudPass = $length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);

        for ($i=1; $i <= $longitudPass; $i++) { 
            $pos = rand(0, $longitudCadena-1);
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }

    /**
     * Función que genera un token para recuperación de contraseñas
     *
     * @return string Token generado
     */
    function token(){
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
        return $token;
    }

    /**
     * Función que da formato a números
     *
     * @param int $cantidad
     * @return string Cadena de números formateado 
     */
    function formatMoney($cantidad){
        $cantidad = number_format($cantidad, 2, SPD, SPM);
        return $cantidad;
    }
?>