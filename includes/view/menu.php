<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	
	if (!auth())
		exit;
?>
<div class="collapse navbar-collapse navbar-ex1-collapse">
	<ul class="nav navbar-nav side-nav">
		<li>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('home.php')); ?>"><i class="fa fa-shopping-cart"></i>Accueil</a>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutProblemeTechniqueForm.php')); ?>"><i class="fa fa-shopping-cart"></i>Signaler un problème technique</a>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activitesView.php')); ?>"><i class="fa fa-shopping-cart"></i>Les activités du camping</a>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesActivitesView.php')); ?>"><i class="fa fa-shopping-cart"></i> Mes activités</a>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesReservationsView.php')); ?>"><i class="fa fa-shopping-cart"></i>Mes réservations</a>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererSousComptesView.php')); ?>"><i class="fa fa-shopping-cart"></i>Gérer sous comptes</a>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('lesPartenairesView.php')); ?>"><i class="fa fa-shopping-cart"></i> Les partenaires  </a>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesEquipesView.php')); ?>"><i class="fa fa-shopping-cart"></i> Mes équipes   </a>
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('lesLieuxCommunsView.php')); ?>"><i class="fa fa-shopping-cart"></i> Espaces communs   </a>	
			<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesProblemesTechniquesView.php')); ?>"><i class="fa fa-shopping-cart"></i> Mes problèmes techniques  </a>	
			<?php
				if ($_SESSION["access_level"]!="CLIENT")
				{
					?>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutLieuCommunForm.php')); ?>"><i class="fa fa-shopping-cart"></i>Ajouter un lieu commun</a>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutPartenaireForm.php')); ?>"><i class="fa fa-shopping-cart"></i>Ajouter un partenaire </a>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutUserForm.php')); ?>"><i class="fa fa-shopping-cart"></i>Ajouter un utilisateur </a>
					<?php
				}
			?>			
		</li>
	</ul>
</div>