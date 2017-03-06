<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	
	if (!auth())
		exit();
?>
<div class="col-lg-3 col-md-6">
	<div class="panel panel-primary">
		<div class="panel-heading"></div>
		<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reserverRestau.php')); ?>">
			<div class="panel-footer">
				<span class="pull-left">Réserver un restaurant</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>
<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading"></div>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reserverLieuCommun.php')); ?>">
				<div class="panel-footer">
					<span class="pull-left">Réserver Lieu Commun</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>