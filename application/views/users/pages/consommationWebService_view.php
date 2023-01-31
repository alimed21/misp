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
					<p class="text-subtitle text-muted">La liste des systèmes d'information</p>
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
							<h5 class="card-title">Liste de vos systèmes d'information</h5>
						</div>
						<div class="card-body">
							<div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
								<?php if($listeSI != false):?>
									<?php foreach($listeSI as $info):?>
										<!--<div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
											<h3><?php echo $info->nom_si;?></h3>
										</div>-->
										<div class="card" style="width: 18rem;">
											<div style="text-align: center;">
												<img src="<?php echo base_url();?>uploads/logo/<?php echo $info->logo;?>" style="width: 150px;height: 150px;" alt="...">
											</div>
											<div class="card-body" style="text-align: center;">
												<h5 class="card-title"><?php echo $info->nom_si;?></h5>
												<p>
													<strong><?php echo $info->nom_service;?></strong>
												</p>
												<a href="<?php echo base_url();?>Consommation/services/<?php echo $info->id_si;?>/<?php echo $info->id_service;?>" class="btn btn-primary">Voir les services</a>
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
