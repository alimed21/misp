<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MISP - <?php echo $titreAffiche;?></title>
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/logo/logo.png"/>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pages/auth.css">

	<style>
		.centerImg{
			text-align: center;
		}
		.centerImg img{
			margin-top: 150px;
		}
		.centerText{
			text-align: center;
			text-align: center;
		}
		.centerText h3{
			color: white;
			font-size: 34px;
		}
		.infoMessage p{
			color:red;
			font-size: 14px;
		}
	</style>
</head>

<body>
<div id="auth">

	<div class="row h-100">
		<div class="col-lg-5 col-12">
			<div id="auth-left">
				<div class="auth-logo">
					<a href="#"><img src="<?php echo base_url();?>assets/images/logo/logo.png" alt="Logo" style="width:100%;height:auto"></a>
				</div>
				<h1 class="auth-title">Portail National.</h1>
				<p class="auth-subtitle mb-5">Pour l'utilisation de la PNI.</p>

				<?php if (isset($error_message)) { ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $error_message; ?>
					</div>
				<?php } ?>

				<form action="<?php echo base_url();?>Connexion/loginVerification" method="post">
					<div class="form-group position-relative has-icon-left mb-4">
						<input type="text" class="form-control form-control-xl" name="username" placeholder="Veuillez saisir votre nom d'utilisateur">
						<div class="form-control-icon">
							<i class="bi bi-person"></i>
						</div>
						<span class="infoMessage"><?php echo form_error('username'); ?></span>
					</div>
					<div class="form-group position-relative has-icon-left mb-4" style="margin-bottom: -15px !important;">
						<input type="password" class="form-control form-control-xl" name="pass" placeholder="Veuillez saisir votre mot de passe">
						<div class="form-control-icon">
							<i class="bi bi-person"></i>
						</div>
						<span class="infoMessage"><?php echo form_error('pass'); ?></span>
					</div>
					<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Connexion</button>
				</form>

			</div>
		</div>
		<div class="col-lg-7 d-none d-lg-block">
			<div id="auth-right">
				<div class="centerImg">
					<img src="<?php echo base_url();?>assets/images/logo/presidence.png" alt="">
				</div>

				<div class="centerText">
					<h3>
						Secrétariat Général du Gouvernement
					</h3>
				</div>
			</div>
		</div>
	</div>

</div>
</body>

</html>
