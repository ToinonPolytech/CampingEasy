<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	?>
	<div class="col-lg-6" style="width:100%;" name="form-connexion" id="form-connexion">
		<?php
		if (auth()) 
		{	 
			?>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutProblemeTechniqueForm.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Signaler un problème technique</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activitesView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Les activités du camping</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesActivitesView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Mes activités</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activitesUsersView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Activités proposées par des clients</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesReservationsView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Mes réservations</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererSousComptesView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Gérer sous comptes</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('lesPartenairesView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Les partenaires</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesEquipesView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Mes équipes</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('nosServicesView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Nos services</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reserverEtatDesLieuxForm.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Réserver mon état des lieux </span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesProblemesTechniquesView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Mes problèmes techniques</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('classementEquipesView.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Classement des équipes</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reserverServices.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Réserver un Service</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>	
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('mesMessages.php')); ?>">
						<div class="panel-footer">
							<span class="pull-left">Mes conversations</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>				
			<?php
				if ($_SESSION["access_level"]!="CLIENT")
				{
					?>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading"></div>
							<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutLieuCommunForm.php')); ?>">
								<div class="panel-footer">
									<span class="pull-left">Ajouter un lieu commun</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading"></div>
							<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererUsersView.php')); ?>">
								<div class="panel-footer">
									<span class="pull-left">Gérer les utilisateurs </span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading"></div>
							<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererProblemesTechniquesView.php')); ?>">
								<div class="panel-footer">
									<span class="pull-left">Gérer les problèmes techniques</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading"></div>
							<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutEtatDesLieuxForm.php')); ?>">
								<div class="panel-footer">
									<span class="pull-left">Ajouter un état des lieux </span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading"></div>
							<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutRestaurantForm.php')); ?>">
								<div class="panel-footer">
									<span class="pull-left">Ajouter un restaurant </span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<?php
				}
		}
		else
		{
			$database = new Database();
			if (!isset($_GET["new"]) && isset($_COOKIE["clef"]) && $database->count('users', array("clef" => htmlspecialchars($_COOKIE["clef"])))==1)
			{
				?>
				<span class="pull-left">Bonjour, <?php echo htmlspecialchars($database->getValue('users', array("clef" => htmlspecialchars($_COOKIE["clef"])), "nom"))." ".htmlspecialchars($database->getValue('users', array("clef" => htmlspecialchars($_COOKIE["clef"])), "prenom")); ?></span><br/>
				<form role="form">
					<div class="form-group">
						<?php
						if ($database->count('users', array("clef" => htmlspecialchars($_COOKIE["clef"]), "code" => NULL))==1)
						{
						?>
							<input type="text" class="form-control" name="code" id="code" placeholder="Créez votre mot de passe de 4 caractères."><br/>
						<?php
						}
						else
						{
						?>
							<input type="text" class="form-control" name="code" id="code" placeholder="Votre mot de passe de 4 caractères."><br/>
						<?php
						}
						?>
						<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('connexionUser.controller.php')); ?>', {code : $('#code').val()}, '#form-connexion', 'prepend'); return false;">Se connecter 2/2</button>
					</div>
				</form>	
				<?php
			}
			else
			{
				if (isset($_COOKIE["clef"]))
					setcookie("clef", "", time()-3600);
				
				?>
				<form role="form" onsubmit="$(this).children().children('button').click(); return false;">
					<div class="form-group">
						<label class="control-label">Votre identifiant</label>
						<input type="text" class="form-control" name="clef" id="clef" placeholder="Votre identifiant de 6 caractères."><br/>
						<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('connexionUser.controller.php')); ?>', {clef : $('#clef').val()}, '#form-connexion', 'prepend'); return false;">Se connecter 1/2</button>
					</div>
				</form>		
				<?php
			}
		}
		?>
	</div>