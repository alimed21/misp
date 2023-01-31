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
                    <h3>Serveur de sécurité</h3>
                    <p class="text-subtitle text-muted">Ajouter un serveur de sécurité</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Serveur de sécurité</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ajout</li>
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
                                <form class="form form-vertical" action="<?php echo base_url();?>Admin/ServSecu/verificationAjout" method="post">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Nom de l'Institution</label>
                                                    <div class="position-relative">
														<select name="inst" id="inst" class="form-control">
															<?php if($listeInst != false):?>
																<?php foreach($listeInst as $ins):?>
																	<option value="<?php echo $ins->id_inst;?>"><?php echo $ins->nom_inst;?></option>
																<?php endforeach;?>
															<?php else:?>
																<option disabled>Aucune institution enregistrer</option>
															<?php endif;?>
														</select>

                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                        <span class="infoMessage"><?php echo form_error('inst'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="email-id-icon">Lien du serveur de sécurité</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="lien_serv" placeholder="Veuillez saisir le lien du serveur de sécurité"
                                                               id="lien_serv">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-envelope"></i>
                                                        </div>
                                                        <span class="infoMessage"><?php echo form_error('lien_serv'); ?></span>
                                                    </div>
                                                </div>
                                            </div>

											<div class="col-12">
												<div class="form-group has-icon-left">
													<label for="email-id-icon">L'environnement du serveur de sécurité</label>
													<div class="position-relative">
														<input type="text" class="form-control" name="env_serv" placeholder="Veuillez saisir l'environnement du serveur de sécurité"
															   id="env_serv">
														<div class="form-control-icon">
															<i class="bi bi-envelope"></i>
														</div>
														<span class="infoMessage"><?php echo form_error('env_serv'); ?></span>
													</div>
												</div>
											</div>

											<div class="col-12">
												<div class="form-group has-icon-left">
													<label for="email-id-icon">Classe du serveur de sécurité</label>
													<div class="position-relative">
														<input type="text" class="form-control" name="class_serv" placeholder="Veuillez saisir la classe du serveur de sécurité"
															   id="class_serv">
														<div class="form-control-icon">
															<i class="bi bi-envelope"></i>
														</div>
														<span class="infoMessage"><?php echo form_error('class_serv'); ?></span>
													</div>
												</div>
											</div>

											<div class="col-12">
												<div class="form-group has-icon-left">
													<label for="email-id-icon">Code du serveur de sécurité</label>
													<div class="position-relative">
														<input type="text" class="form-control" name="code_serv" placeholder="Veuillez saisir le code du serveur de sécurité"
															   id="code_serv">
														<div class="form-control-icon">
															<i class="bi bi-envelope"></i>
														</div>
														<span class="infoMessage"><?php echo form_error('code_serv'); ?></span>
													</div>
												</div>
											</div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Ajouter</button>
                                                <button type="reset" class="btn btn-light-danger me-1 mb-1">Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
