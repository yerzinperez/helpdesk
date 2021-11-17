<?php
	headerDashboard($data);
	getModal('modalUsers', $data);
?>
<!-- Contenido -->
<div class="page-content">
	<div class="container-fluid">
		<header class="section-header">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Usuarios</h3>
						<ol class="breadcrumb breadcrumb-simple">
							<li><a href="<?php echo base_url() ?>">Dashboard</a></li>
							<li class="active"><?php echo $data['page_title']; ?></li>
						</ol>
					</div>
					<div class="tbl-cell" style="text-align: end;">
						<button class="btn btn-primary" type="button" onclick="abrirModal();"><i class="fas fa-plus-circle"></i> Nuevo</button>
					</div>
				</div>
			</div>
		</header>

		<section class="card">
				<div class="card-block">
					<table id="userTable" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Nombres y apellidos</th>
							<th>Departamento</th>
							<th style="width: 10%;">Rol</th>
							<th>Correo eletrónico</th>
							<th>Teléfono</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>Nombres y apellidos</th>
							<th>Departamento</th>
							<th>Rol</th>
							<th>Correo eletrónico</th>
							<th>Celular</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
						</tfoot>
						<tbody>
						</tbody>
					</table>
				</div>
			</section>

	</div>
</div>
<?php footerDashboard($data); ?>