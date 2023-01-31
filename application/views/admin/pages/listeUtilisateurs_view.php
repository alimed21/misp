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
					<h3>Utilisateur</h3>
					<p class="text-subtitle text-muted">La liste des utilisateurs</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Utilisateur</a></li>
							<li class="breadcrumb-item active" aria-current="page">Listes</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="section">
			<div class="card">
				<div class="card-header">
					<a href="<?php echo base_url();?>Admin/Utilisateur/ajoutUtilisateur">
						<button class="btn btn-primary">
							Ajouter un utilisateur
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
							<th>Nom d'utilisateur</th>
							<th>Institution</th>
							<th>Ajouter le</th>
							<th>Ajouter par</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php if($listeUsers != false):?>
							<?php foreach($listeUsers as $users):?>
								<tr>
									<td><?php echo $users->username;?></td>
									<td><?php echo $users->nom_inst;?></td>
									<td><?php echo $users->date_ajout;?></td>
									<td><?php echo $users->login_admin;?></td>
									<td>
										<a href="<?php echo base_url();?>Admin/Utilisateurs/modifierUtilisateur/<?php echo $users->id_user;?>">
											<i class="fa fa-edit"></i>
										</a>
										|
										<a href="<?php echo base_url();?>Admin/Utilisateurs/supprimerUtilisateur/<?php echo $users->id_user;?>">
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
