<!DOCTYPE html>
<html>

<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">  -->
	<title><?php echo $data['page_title']; ?></title>
	<link href="<?php echo media()?>image/icons/favicon.png" rel="icon" type="image/png">

	<link rel="stylesheet" href="<?php echo media()?>css/separate/pages/login.min.css">
	<link rel="stylesheet" href="<?php echo media()?>css/lib/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo media()?>css/lib/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo media()?>css/main.css">
</head>

<body>
	<div class="page-center">
		<div class="page-center-in">
			<div class="container-fluid">
				<form class="sign-box" action="" method="post" id="frmLoginForm">
					<div class="sign-avatar m-b">
						<i class="fas fa-user-circle fa-7x" id="icoUser"></i>
					</div>
					<header class="sign-title">Acceso a YerDesk</header>
					<div id="divValidate"></div>
					<div class="form-group">
						<input type="email" id="userEmail" name="userEmail" class="form-control" placeholder="Correo" />
					</div>
					<div class="form-group">
						<input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="Contraseña" />
					</div>
					<div class="form-group">
						<div class="float-right reset">
							<a href="#">Olvidé mi contraseña</a>
						</div>
					</div>
					<button type="submit" class="btn btn-rounded" id="btnAcceder">Acceder</button>
				</form>
			</div>
		</div>
	</div>
	<!-- Libreries -->
	<script type="text/javascript" src="<?php echo media()?>js/lib/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo media()?>js/lib/tether/tether.min.js"></script>
	<script type="text/javascript" src="<?php echo media()?>js/lib/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo media()?>js/plugins.js"></script>
	<script type="text/javascript" src="<?php echo media()?>js/lib/match-height/jquery.matchHeight.min.js"></script>
	<script type="text/javascript" src="<?php echo media()?>js/app.js"></script>
	<script type="text/javascript" src="<?php echo media()?>js/lib/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="https://kit.fontawesome.com/8c8225f4fd.js" crossorigin="anonymous"></script>
	<!-- Custom JS -->
	<script type="text/javascript" type="text/javascript" src="<?php echo media()?>js/helpers.js"></script>
	<script src="<?php echo $data['page_functions']?>"></script>
</body>
</html>