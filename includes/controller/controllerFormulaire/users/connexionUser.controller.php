<?php
if (!isset($_SESSION))
	session_start();

require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("user.class.php"));
require_once(i("user.controller.class.php"));
require_once(i("client.controller.class.php"));
?>
<div class="alert alert-danger" role="alert" name="infoErreur" id="infoErreur">
	<?php
	$database = new Database();
	if ((isset($_POST["clef"]) && $database->count('users', array("clef" => $_POST["clef"]))) || (isset($_COOKIE["clef"]) && $database->count('users', array("clef" => $_COOKIE["clef"]))))
	{
		if (isset($_POST["code"]))
		{
			if ($database->count('users', array("clef" => $_COOKIE["clef"])))
			{
				$database->select('users', array("clef" => $_COOKIE["clef"]), "id");
				$data = $database->fetch();
				$user=new User($data["id"]);
				if ($user->getCode()==NULL || $user->getCode()==$_POST["code"])
				{
					if ($user->getCode()==NULL) // Première connexion
					{
						if (strlen($_POST["code"])==4 && is_numeric($_POST["code"]))
						{
							$user->setCode($_POST["code"]);
							$user->saveToDb();
						}
						else
						{
							echo "<strong>Oops</strong><br/>";
							echo "Votre mot de passe ne doit pas dépasser les 4 caractères numériques.";
							?>
							<script type="text/javascript">
								$("#infoErreur").fadeOut(5500, function(){ $("#infoErreur").remove(); });
							</script>
							<?php
							exit(); // On stop le fichier
						}
					}
					$controller= new Controller_Client($user);
					if (!$controller->can(CAN_LOG))
					{
						echo "<strong>Oops</strong><br/>";
						echo "Votre compte semble être bloqué.";
						?>
						<script type="text/javascript">
							$("#infoErreur").fadeOut(5500, function(){ $("#infoErreur").remove(); });
						</script>
						<?php
						exit(); // On stop le fichier
					}
					$_SESSION["id"]=$user->getId(); // Et hop ! On est connecté 
					$_SESSION["access_level"]=$user->getAccessLevel();
					$_SESSION["infoId"]=$user->getUserInfos()->getId();
					?>
					<script type="text/javascript">
						loadToMain("includes/view/home.php", "{}");
					</script>
					<?php
				}
				else
				{
					echo "<strong>Oops</strong><br/>";
					echo "Un problème est survenu lors de la connexion.";
					?>
					<script type="text/javascript">
						$("#infoErreur").fadeOut(5500, function(){ $("#infoErreur").remove(); });
					</script>
					<?php
				}
			}
			else
			{
				echo "<strong>Oops</strong><br/>";
				echo "Un problème est survenu lors de la connexion.";
				?>
				<script type="text/javascript">
					$("#infoErreur").fadeOut(5500, function(){ $("#infoErreur").remove(); });
				</script>
				<?php
			}
		}
		else
		{
			setcookie("clef", $_POST["clef"], time()+7*3600*24, "/");
			?>
			<script type="text/javascript">
				loadToMain("includes/view/home.php", "{}");
			</script>
			<?php
		}
	}
	else
	{
		echo "<strong>Oops</strong><br/>";
		echo "Un problème est survenu lors de la connexion.";
		?>
		<script type="text/javascript">
			$("#infoErreur").fadeOut(5500, function(){ $("#infoErreur").remove(); });
		</script>
		<?php
	}
	?>
</div>