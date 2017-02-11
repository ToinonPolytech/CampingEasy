<?php
require("../../modele/database.class.php");
require("../../modele/user.class.php");
require("../../modele/user.controller.class.php");

$database = new Database();
if (isset($_POST["clef"]) && $database->count('users', array("clef" => $_POST["clef"])))
{
	if (isset($_POST["code"]))
	{
		if ($database->count('users', array("clef" => $_POST["clef"], "code" => $_POST["code"])))
		{
			$database->select('users', array("clef" => $_POST["clef"], "code" => $_POST["code"]), array("id"));
			$data=$database->fetch();
			$_SESSION["id"]=$data["id"]; // Et hop ! On est connecté 
			/**
				TODO : Je dois appeller mon frère pour voir à propos des sessions si c'est une bonne idée de stocker plus de données que juste l'id.
				J'aimerais bien, au moins, rajouter l'info_id et l'access_level.
			**/
			?>
			<script type="text/javascript">
				loadToMain("includes/home.php", "{}");
			</script>
			<?php
		}
		else
		{
			echo "ERREUR : Un problème est survenu lors de la connexion.";
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
	echo "ERREUR : Un problème est survenu lors de la connexion.";
}
?>