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
                    <h3>Administrateur</h3>
                    <p class="text-subtitle text-muted">La liste des administrateurs</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Administrateurs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Listes</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo base_url();?>Admin/Administrateur/ajoutAdmin">
                        <button class="btn btn-primary">
                            Ajouter un administrateur
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
                            <th>Id</th>
                            <th>Nom d'utilisateur</th>
                            <th>Date jouter</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if($listeAdmin != false):?>
                                <?php foreach($listeAdmin as $ad):?>
                                    <tr>
                                        <td><?php echo $ad->id_admin;?></td>
                                        <td><?php echo $ad->login_admin;?></td>
                                        <td><?php echo $ad->date_add;?></td>
                                        <td>
                                            <a href="<?php echo base_url();?>Admin/Utilisateurs/modifierUtilisateur/<?php echo $ad->id_admin;?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            |
                                            <a href="<?php echo base_url();?>Admin/Utilisateurs/supprimerUtilisateur/<?php echo $ad->id_admin;?>">
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