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
					<h3>Web service</h3>
					<p class="text-subtitle text-muted">Modifier un web service</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Web service</a></li>
							<li class="breadcrumb-item active" aria-current="page">Modification</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="row match-height">
				<div class="col-md-6 col-12">
					<div class="card">
						<div class="card-content">
							<div class="card-body">
								<?php if ($this->session->flashdata('error')) :?>
									<div class="alert alert-danger">
										<?php echo $this->session->flashdata('error'); ?>
									</div>
								<?php endif;?>
								<?php if($detailWS != false):?>
									<?php foreach ($detailWS as $web):?>
										<form class="form form-vertical" action="<?php echo base_url();?>WebService/verificationmodification" method="post">
											<div class="form-body">
												<div class="row">
													<div class="col-12">
														<input type="hidden" name="id_service" value="<?php echo $web->id_service;?>">
														<div class="form-group has-icon-left">
															<label for="first-name-icon">Service web</label>
															<div class="position-relative">
																<input type="text" class="form-control"
																	   placeholder="Veuillez saisir le nom du service web" name="web_service" id="web_service" value="<?php echo $web->nom_service;?>">
																<div class="form-control-icon">
																	<i class="bi bi-person"></i>
																</div>
																<span class="infoMessage"><?php echo form_error('web_service'); ?></span>
															</div>
														</div>
													</div>

													<div class="col-12">

														<div class="col-12 d-flex justify-content-end">
															<button type="submit" class="btn btn-success me-1 mb-1">Modifier</button>
															<button type="reset" class="btn btn-light-danger me-1 mb-1">Annuler</button>
														</div>
													</div>
												</div>
											</div>
										</form>
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
