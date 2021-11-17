<!DOCTYPE html>
<html>

<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">  -->
	<title><?php echo $data['page_title']; ?></title>
	<link href="<?php echo media()?>image/icons/favicon.png" rel="icon" type="image/png">

	<link rel="stylesheet" href="<?php echo media()?>css/separate/pages/error.min.css">
	<link rel="stylesheet" href="<?php echo media()?>css/lib/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo media()?>css/lib/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo media()?>css/main.css">
</head>

<body>
    <div class="page-error-box">
        <div class="error-code">404</div>
        <div class="error-title">Página no encontrada</div>
        <a href="<?php echo BASE_URL?>" class="btn btn-rounded">Ir a la página de inicio</a>
        <br></br>
        <p><?php if($GLOBALS["ERROR_USER"] != ''){echo $GLOBALS["ERROR_USER"];}?></p>
    </div>
    <script type="text/javascript"><?php echo 'console.error("'.$GLOBALS["ERROR_ADMIN"].'");'?></script>
</body>

</html>