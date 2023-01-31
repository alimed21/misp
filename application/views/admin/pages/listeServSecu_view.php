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
                    <p class="text-subtitle text-muted">La liste des serveurs de sécurités</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Serveur de sécurité</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Listes</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo base_url();?>Admin/ServSecu/ajoutServSecu">
                        <button class="btn btn-primary">
                            Ajouter d'un serveur de sécurité
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')) :?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif;?>

                    <?php if ($this->session->flashdata('error')) :?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif;?>
                    <table class="table table-striped" id="table1">
                        <thead>
                        <tr>
                            <th>Institution</th>
                            <th>Lien</th>
                            <th>Nom</th>
							<th>Classe</th>
							<th>Code</th>
							<th>Ajouter le</th>
							<th>Ajouter par</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if($listeServ != false):?>
                                <?php foreach($listeServ as $serv):?>
                                    <tr>
                                        <td><?php echo $serv->nom_court_inst;?></td>
                                        <td><?php echo $serv->lien_serv;?></td>
                                        <td><?php echo $serv->nom_serv;?></td>
									  	<td><?php echo $serv->class_serv;?></td>
									 	<td><?php echo $serv->code_serv;?></td>
									 	<td><?php echo $serv->date_ajout;?></td>
									 	<td><?php echo $serv->login_admin;?></td>
                                        <td>
                                            <a href="<?php echo base_url();?>Admin/Utilisateurs/modifierUtilisateur/<?php echo $serv->id_serv;?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            |
                                            <a href="<?php echo base_url();?>Admin/Utilisateurs/supprimerUtilisateur/<?php echo $serv->id_serv;?>">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php else:?>
                            <?php endif;?>

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>