<?php
require_once("../../modele/database.class.php");
require_once("../../modele/user.class.php");
require_once("../controllerObjet/user.controller.class.php");
?>
<div class="alert alert-danger" role="alert" name="infoErreur" id="infoErreur">
	<?php
	$database = new Database();
	if (isset($_POST["clef"]) && $database->count('users', array("clef" => $_POST["clef"])))
	{
		if (isset($_POST["code"]))
		{
			if ($database->count('users', array("clef" => $_POST["clef"], "code" => $_POST["code"])))
			{
				$database->select('users', array("clef" => $_POST["clef"], "code" => $_POST["code"]), array("id", "access_level"));
				$data=$database->fetch();
				$_SESSION["id"]=$data["id"]; // Et hop ! On est connecté 
				$_SESSION["access_level"]=$data["access_level"];
				?>
				<script type="text/javascript">
					loadToMain("includes/home.php", "{}");
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
			setcookie("clef", $_POST["clef"], time()+7*3600*24);
			?>
			<script type="text/javascript">
				loadToMain("includes/home.php", "{}");
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