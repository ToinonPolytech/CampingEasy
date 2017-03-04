<?php
if (!isset($_SESSION))
	session_start();

require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("user.class.php"));
require_once(i("user.controller.class.php"));
print_r($_POST); 
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
				$database->select('users', array("clef" => $_COOKIE["clef"]), "code");
				$data = $database->fetch();
				if ($data["code"]==NULL || $data["code"]==$_POST["code"]) 
				{
					if ($data["code"]==NULL) // Première connexion
					{
						if (strlen($_POST["code"])==4 && is_numeric($_POST["code"]))
							$database->update('users', array("clef" => $_COOKIE["clef"]), array("code" => $_POST["code"])); // On met le code en db
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
					$database->select('users', array("clef" => $_COOKIE["clef"]), array("id", "access_level", "infoId"));
					$data=$database->fetch();
					$_SESSION["id"]=$data["id"]; // Et hop ! On est connecté 
					$_SESSION["access_level"]=$data["access_level"];
					$_SESSION["infoId"]=$data["infoId"];
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