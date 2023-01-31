<div id="main">
	<header class="mb-3">
		<a href="#" class="burger-btn d-block d-xl-none">
			<i class="bi bi-justify fs-3"></i>
		</a>
	</header>

	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3>Consommation</h3>
					<p class="text-subtitle text-muted">Retour des données</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">

				</div>
			</div>
		</div>
		<section class="section">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Information de la personne</h5>
						</div>
						<div class="card-body">
							<div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
								<?php if($person != false):?>
									<?php foreach($person as $r):?>
										<div class="card">
											<div class="card-content">
												<div class="card-body">
													<h4 class="card-title">Détail de la personne avec le CNI <?php echo $r->C1;?></h4>

													<div class="form-body infoPers">
														<div class="form-group">
															<p>
																Nom de la personne : <?php echo $r->C4;?> <?php echo $r->C5;?> <?php echo $r->C6;?>
															</p>
														</div>
														<div class="form-group">
															<p>Date de naissance : <?php echo date("d-m-Y",strtotime($r->C7));?></p>
														</div>
														<div class="form-group">
															<p>Lieu de naissance : <?php echo $r->C8;?></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach;?>
								<?php else:?>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
