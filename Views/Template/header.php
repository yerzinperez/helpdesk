<!DOCTYPE html>
<html>

<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link href="<?php echo media() ?>image/icons/favicon.png" rel="icon" type="image/png">
	<title><?php echo $data['page_title']; ?></title>

	<link rel="stylesheet" href="<?php echo media() ?>css/separate/vendor/fancybox.min.css">
	<link rel="stylesheet" href="<?php echo media() ?>css/separate/pages/activity.min.css">

	<link rel="stylesheet" href="<?php echo media() ?>css/lib/summernote/summernote.css" />
	<link rel="stylesheet" href="<?php echo media() ?>css/separate/pages/editor.min.css">

	<link rel="stylesheet" href="<?php echo media() ?>css/lib/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo media() ?>css/lib/bootstrap/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo media() ?>css/lib/bootstrap-sweetalert/sweetalert.css">
	<link rel="stylesheet" href="<?php echo media() ?>css/separate/vendor/sweet-alert-animations.min.css">

	<link rel="stylesheet" href="<?php echo media() ?>css/lib/datatables-net/datatables.min.css">
	<link rel="stylesheet" href="<?php echo media() ?>css/separate/vendor/datatables-net.min.css">

	<link rel="stylesheet" href="<?php echo media() ?>css/separate/vendor/bootstrap-select/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?php echo media() ?>css/separate/vendor/select2.min.css">

	<link rel="stylesheet" href="<?php echo media() ?>css/separate/vendor/bootstrap-daterangepicker.min.css">
	<link rel="stylesheet" href="<?php echo media() ?>css/separate/pages/widgets.min.css">

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<link rel="stylesheet" href="<?php echo media() ?>css/main.css">
</head>

<body class="with-side-menu">
	<header class="site-header">
		<div class="container-fluid">

			<a href="<?php echo BASE_URL ?>dashboard" class="site-logo">
				<img class="hidden-md-down" src="<?php echo media() ?>image/icons/logo-2.png" alt="">
				<img class="hidden-lg-up" src="<?php echo media() ?>image/icons/logo-2-mob.png" alt="">
			</a>

			<button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
				<span>toggle menu</span>
			</button>

			<button class="hamburger hamburger--htla">
				<span>toggle menu</span>
			</button>

			<div class="site-header-content">
				<div class="site-header-content-in">
					<div class="site-header-shown">
						<div class="dropdown widget widget-time reloj">
							<div class="widget-time-content">
								<div class="count-item">
									<div class="count-item-number" id="txtHora">00</div>
									<div class="count-item-caption">hora</div>
								</div>
								<div class="count-item divider">:</div>
								<div class="count-item">
									<div class="count-item-number" id="txtMinuto">00</div>
									<div class="count-item-caption">minuto</div>
								</div>
								<div class="count-item divider">:</div>
								<div class="count-item">
									<div class="count-item-number" id="txtSegundo">00</div>
									<div class="count-item-caption">segundo</div>
								</div>
								<div class="count-item">
									<div class="count-item-number" id="AMPM">AM</div>
								</div>
							</div>
						</div>
						<!--.widget-time-->
						<div class="dropdown dropdown-notification notif">
							<a href="#" class="header-alarm dropdown-toggle active" id="dd-notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="font-icon-alarm"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-notif" aria-labelledby="dd-notification">
								<div class="dropdown-menu-notif-header">
									Notifications
									<span class="label label-pill label-danger">4</span>
								</div>
								<div class="dropdown-menu-notif-list">
									<div class="dropdown-menu-notif-item">
										<div class="photo">
											<img src="img/photo-64-1.jpg" alt="">
										</div>
										<div class="dot"></div>
										<a href="#">Morgan</a> was bothering about something
										<div class="color-blue-grey-lighter">7 hours ago</div>
									</div>
									<div class="dropdown-menu-notif-item">
										<div class="photo">
											<img src="img/photo-64-2.jpg" alt="">
										</div>
										<div class="dot"></div>
										<a href="#">Lioneli</a> had commented on this <a href="#">Super Important Thing</a>
										<div class="color-blue-grey-lighter">7 hours ago</div>
									</div>
									<div class="dropdown-menu-notif-item">
										<div class="photo">
											<img src="img/photo-64-3.jpg" alt="">
										</div>
										<div class="dot"></div>
										<a href="#">Xavier</a> had commented on the <a href="#">Movie title</a>
										<div class="color-blue-grey-lighter">7 hours ago</div>
									</div>
									<div class="dropdown-menu-notif-item">
										<div class="photo">
											<img src="img/photo-64-4.jpg" alt="">
										</div>
										<a href="#">Lionely</a> wants to go to <a href="#">Cinema</a> with you to see <a href="#">This Movie</a>
										<div class="color-blue-grey-lighter">7 hours ago</div>
									</div>
								</div>
								<div class="dropdown-menu-notif-more">
									<a href="#">See more</a>
								</div>
							</div>
						</div>
						<div class="dropdown user-menu">
							<button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="<?php echo media() ?>image/uploads/1.jpg" alt="Foto de perfíl">
								<!-- <img src="../../public/<?php //echo $_SESSION["rol_id"] 
															?>.jpg" alt=""> -->
							</button>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
								<a class="dropdown-item" href="../Perfil/"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo BASE_URL ?>Logout"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
							</div>
						</div>
					</div>

					<div class="mobile-menu-right-overlay"></div>

					<input type="hidden" id="id_user" value="<?php echo $_SESSION['idUser'] ?>"><!-- ID del Usuario-->
					<input type="hidden" id="id_rol" value="<?php echo $_SESSION['userData']['id_rol'] ?>"><!-- Rol del Usuario-->

					<span class="font-icon font-icon-user"></span>
					<?php echo $_SESSION['userData']['nombres'] . " " . $_SESSION['userData']['apellidos'] . " - " . $_SESSION['userData']['rol'];
					?></span>
					<!-- <div class="dropdown dropdown-typical">
						<a href="#" class="dropdown-toggle no-arr">
							<span class="lblcontactonomx">
						</a>
					</div> -->

				</div>
			</div>
		</div>
	</header>

	<nav class="side-menu"">
				<ul class=" side-menu-list">
		<li class="blue dashboard-menu menu">
			<a href="<?php echo BASE_URL ?>dashboard">
				<i class="font-icon glyphicon font-icon-dashboard"></i>
				<span class="lbl">Dashboard</span>
			</a>
		</li>
		<?php if($_SESSION['userData']['id_rol'] != 4){ ?>
		<li class="gold tickets-menu menu">
			<a href="<?php echo base_url() ?>ticket/tickets">
				<i class="font-icon glyphicon glyphicon-comment"></i>
				<span class="lbl">Tickets</span>
			</a>
		</li>
		<?php } ?>
		<li class="green mis-tickets-menu menu">
			<a href="<?php echo base_url() ?>MisTickets/misTickets">
				<i class="font-icon glyphicon glyphicon-tags"></i>
				<span class="lbl">Mis tickets</span>
			</a>
		<?php if($_SESSION['userData']['id_rol'] == 1){ ?>
		<li class="red with-sub usuarios-menu menu">
			<a href="<?php echo base_url() ?>usuario/usuarios">
							<i class=" font-icon glyphicon glyphicon-user"></i>
				<span class="lbl">Usuarios</span>
			</a>
		</li>
		<li class="grey with-sub ajustes-menu menu">
			<span>
				<i class="font-icon glyphicon glyphicon-cog"></i>
				<span class="lbl">Ajustes</span>
			</span>
			<ul>
				<li><a href=""><span class="lbl">Departamentos</span></a></li>
				<li><a href=""><span class="lbl">Categorías</span></a></li>
			</ul>
		</li>
		<?php } ?>
		</section>
	</nav>
	<div class="mobile-menu-left-overlay"></div>