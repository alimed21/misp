<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titreAffiche;?></title>
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
        .infoPers p{
            color: black;
        }
        .infoPers p span{
            font-weight: bold;
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
            <h1 class="auth-title">Registre National.</h1>
            <p class="auth-subtitle mb-5">Information d'une personne.</p>

            <form action="<?php echo base_url();?>Registre/recherchePersonne" method="post">
                <div class="form-group position-relative has-icon-left mb-4" style="margin-bottom: -15px !important;">
                    <input type="number" class="form-control form-control-xl" name="cin" placeholder="Veuillez saisir le CIN d'une personne">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    <span class="infoMessage"><?php echo form_error('cin'); ?></span>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Rechercher</button>
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

    <!--large size Modal -->
    <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17">Information de l'individu</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">

					<?php if($person != false):?>
						<?php foreach($person as $r):?>
                            <div class="infoPers">
                                <p>
                                    <span>Cin</span> : <?php echo $r->cin;?>
                                </p>
                                <p>
								   <span>Nom complet</span> : <?php echo $r->nom1;?> <?php echo $r->nom2;?> <?php echo $r->nom3;?>
                                </p>
                                <p>
									<span>Date de naissance</span> : <?php echo date("d-m-Y",strtotime($r->datenaissance));?>
                                </p>
                                <p>
								 	 <span>Lieu de naissance</span> : <?php echo $r->lieunaissance;?>
                                </p>

                            </div>
                    	<?php endforeach;?>
                    <?php endif;?>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Fermer</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function(){
        $("#large").modal('show');
    });
</script>
</body>

</html>
