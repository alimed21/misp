<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; MISP</p>
        </div>
        <div class="float-end">
            <p>Développer<span class="text-danger"></span> par <a href="https://ansie.dj">ANSIE</a></p>
        </div>
    </div>
</footer>
	<!--Success theme Modal -->
	<div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
		 aria-labelledby="myModalLabel110" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
			 role="document">
			<div class="modal-content">
				<div class="modal-header bg-success">
					<h5 class="modal-title white" id="myModalLabel110">Les informations de votre profil
					</h5>
					<button type="button" class="close" data-bs-dismiss="modal"
							aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<div class="modal-body">
					<?php if($nomInst != false):?>
						<?php foreach($nomInst as $inst):?>
							<div style="text-align: center;">
								<img src="<?php echo base_url();?>uploads/logo/<?php echo $inst->logo;?>" style="width: 150px;height: 150px;" alt="...">
							</div>
							<div style="text-align: center;">
								<label for="username">
									<i class="fa fa-user"></i> <span style="font-weight: bold;"><?php echo $inst->username;?></span>
								</label>
								<br>
								<label for="email">
									<i class="fa fa-building"></i> <span style="font-weight: bold;"><?php echo $inst->nom_inst;?></span>
								</label>
							</div>
						<?php endforeach;?>
					<?php else:?>
					<?php endif;?>
					
				</div>
				<div class="modal-footer">
					<a href="<?php echo base_url();?>Parametres/profilUser">
						<button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
							<i class="bx bx-check d-block d-sm-none"></i>
							<span class="d-none d-sm-block">Modifier</span>
						</button>
					</a>

					<button type="button" class="btn btn-success ml-1" data-bs-dismiss="modal">
						<i class="bx bx-check d-block d-sm-none"></i>
						<span class="d-none d-sm-block">Fermer</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/app.js"></script>

<!-- Need: Apexcharts -->
<script src="<?php echo base_url();?>assets/admin/extensions/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/pages/dashboard.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url();?>assets/admin/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/pages/simple-datatables.js"></script>

<script src="<?php echo base_url();?>assets/admin/js/pages/form-element-select.js"></script>
<script src="<?php echo base_url();?>assets/admin/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/pages/form-element-select.js"></script>

<script src="<?php echo base_url();?>assets/admin/extensions/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/pages/tinymce.js"></script>

</body>

</html>
