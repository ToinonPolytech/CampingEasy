<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	require_once(i("user.class.php"));
	
	if (!auth())
		exit();
	if (!isset($_POST["id"]))
		exit();
	$db=new Database();
	$user=new User($_POST["id"]);
?>
<div class="col-lg-6" name="form-connexion" id="form-connexion">
	<h3>Discussion avec <?php echo htmlentities($user->getNom())." ".htmlentities($user->getPrenom()); ?></h3>
	<?php
		$db->setOrderCol("date");
		$db->setAsc();
		$db->select("messagerie", array("destinataire" => array("OR", array('=', $_POST["id"]), array('=', $_SESSION["id"])), "expediteur" => array("OR", array('=', $_POST["id"]), array('=', $_SESSION["id"]))));		
		while ($data=$db->fetch())
		{
			if ($data["expediteur"]==$_SESSION["id"])
			{
			?>
			<div>
				<p>Vous :<br/>
				<?php echo htmlentities($data["message"]); ?><br/>
				<?php echo date("d/m/Y H:i:s", $data["date"]); ?></p>
			</div>
			<?php	
			}
			else
			{
			?>
			<div>
				<p><?php echo htmlentities($user->getNom())." ".htmlentities($user->getPrenom()); ?> :<br/>
				<?php echo htmlentities($data["message"]); ?><br/>
				<?php echo date("d/m/Y H:i:s", $data["date"]); ?></p>
			</div>
			<?php		
			}
		}
	?>
	<textarea cols="20" rows="1"></textarea>
</div>