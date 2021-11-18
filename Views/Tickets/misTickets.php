<?php headerDashboard($data); ?>
<!-- Contenido -->
<div class="page-content">
	<div class="container-fluid">
		<header class="section-header">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3><?php echo $data['page_title']; ?></h3>
						<ol class="breadcrumb breadcrumb-simple">
							<li><a href="<?php echo base_url() ?>">Dashboard</a></li>
							<li class="active"><?php echo $data['page_title']; ?></li>
						</ol>
					</div>
				</div>
			</div>
		</header>

		<section class="tabs-section">
			<div class="tabs-section-nav">
				<div class="tbl">
					<ul class="nav" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" href="#tabs-2-tab-1" role="tab" data-toggle="tab" aria-selected="true">
								<span class="nav-link-in">
									Tickets abiertos
									<span class="label label-pill label-info">4</span>
								</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--.tabs-section-nav-->

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active show" id="tabs-2-tab-1">
					<table id="tblMisTickets" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Título</th>
								<th>Departamento</th>
								<th>Prioridad</th>
								<th>Asignado a</th>
								<th>Fecha de creación</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Título</th>
								<th>Departamento</th>
								<th>Prioridad</th>
								<th>Asignado a</th>
								<th>Fecha de creación</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</tfoot>
						<tbody>
							<tr>
								<td>Tiger Nixon</td>
								<td>System Architect</td>
								<td>Edinburgh</td>
								<td>61</td>
								<td>61</td>
								<td>61</td>
								<td>2011/04/25</td>
								<td>$320,800</td>
							</tr>
							<tr>
								<td>Garrett Winters</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>63</td>
								<td>63</td>
								<td>63</td>
								<td>2011/07/25</td>
								<td>$170,750</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!--.tab-pane-->
			</div>
			<!--.tab-content-->
		</section>
	</div>
</div>
<?php footerDashboard($data); ?>