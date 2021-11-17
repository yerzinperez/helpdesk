<?php
/**
 * Archivo que define la configuración del proyecto
 */
    define('BASE_URL', 'http://helpdesk2.test/');

    //zona horaria local
    date_default_timezone_set('America/Bogota');

    //Datos de conexion a la base de datos
    const DB_HOST = "localhost";
    const DB_NAME = "bd_yerdesk";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_CHARSET = "charset=utf8";

    //Delimitadores decimal y milla Ej. 24,1989.00
    const SPD = ".";
    const SPM = ".";

    //simbolo de la moneda
    const SMONEY = "$";

    //Datos envio de correo
	const NOMBRE_REMITENTE = "YerDesk";
	const EMAIL_REMITENTE = "yerzin24@gmail.com";
	const NOMBRE_EMPESA = "YerDesk";
	const WEB_EMPRESA = "helpdesk2.test";

    //error
    $GLOBALS["ERROR_USER"] = "";
    $GLOBALS["ERROR_ADMIN"] = "";
?>