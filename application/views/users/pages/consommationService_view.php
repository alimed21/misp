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
					<p class="text-subtitle text-muted">La liste des services</p>
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
							<h5 class="card-title">Liste des services à consommer</h5>
						</div>
						<div class="card-body">
							<div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
								<?php if($listeService != false):?>
									<?php foreach($listeService as $serv):?>
										<div class="card" style="width: 18rem;">
											<div style="text-align: center;">
												<img src="<?php echo base_url();?>uploads/logo/<?php echo $serv->logo;?>" style="width: 150px;height: 150px;" alt="...">
											</div>
											<div class="card-body" style="text-align: center;">
												<h5 class="card-title"><?php echo $serv->nom_service;?></h5>
												<a href="<?php echo base_url();?>Consommation/personCni/<?php echo $serv->id_service;?>/<?php echo $serv->id_system;?>" class="btn btn-primary">Consommer</a>
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
