<?php headerDashboard($data); ?>
		<!-- Contenido -->
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-sm-4">
								<article class="statistic-box green">
									<div>
										<div class="number" id="lbltotal"></div>
										<div class="caption">
											<div>Total de tickets</div>
										</div>
									</div>
								</article>
							</div>
							<div class="col-sm-4">
								<article class="statistic-box yellow">
									<div>
										<div class="number" id="lbltotalabierto"></div>
										<div class="caption">
											<div>Total de tickets abiertos</div>
										</div>
									</div>
								</article>
							</div>
							<div class="col-sm-4">
								<article class="statistic-box red">
									<div>
										<div class="number" id="lbltotalcerrado"></div>
										<div class="caption">
											<div>Total de tickets cerrados</div>
										</div>
									</div>
								</article>
							</div>
						</div>
					</div>
				</div>

				<section class="card">
					<header class="card-header">
						Gráfico estadístico
					</header>
					<div class="card-block">
						<div id="divgrafico" style="height: 250px;"></div>
					</div>
				</section>

			</div>
		</div>
<?php footerDashboard($data); ?>