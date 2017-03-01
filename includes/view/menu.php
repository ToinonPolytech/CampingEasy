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
			<a href="/includes/view/home.php"><i class="fa fa-shopping-cart"></i>Accueil</a>
			<a href="/includes/view/ajoutProblemeTechniqueForm.php"><i class="fa fa-shopping-cart"></i>Signaler un problème technique</a>
			<a href="/includes/view/activitesView.php"><i class="fa fa-shopping-cart"></i>Les activités du camping</a>
			<a href="/includes/view/mesActivitesView.php"><i class="fa fa-shopping-cart"></i> Mes activités</a>
			<a href="/includes/view/mesReservationsView.php"><i class="fa fa-shopping-cart"></i>Mes réservations</a>
			<a href="/includes/view/gererSousComptesView.php"><i class="fa fa-shopping-cart"></i>Gérer sous comptes</a>
			<a href="/includes/view/ajoutEquipeForm.php"><i class="fa fa-shopping-cart"></i> Créer une équipe </a>
			<?php
				if ($_SESSION["access_level"]!="CLIENT")
				{
					?>
					<a href="/includes/view/ajoutLieuCommunForm.php"><i class="fa fa-shopping-cart"></i>Ajouter un lieu commun</a>
					<a href="/includes/view/ajoutPartenaireForm.php"><i class="fa fa-shopping-cart"></i>Ajouter un partenaire </a>
					<a href="/includes/view/ajoutUserForm.php"><i class="fa fa-shopping-cart"></i>Ajouter un utilisateur </a>
					<?php
				}
			?>			
		</li>
	</ul>
</div>