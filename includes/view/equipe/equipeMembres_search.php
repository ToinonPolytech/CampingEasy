 <?php 
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	

	if (!auth() || !isset($_POST["name"]))
		exit();
	
	
	$name=$_POST["name"];
	$db=new Database();
	$db->select("users", array("prenom" => array(' LIKE ', $name."%")), array("id", "prenom", "nom"));
	while ($data=$db->fetch())
	{
		?>
		<span onclick="$('#ajoutPers').val($(this).text());"><?php echo htmlentities($data["prenom"])." ".htmlentities($data["nom"]); ?></span><br/> 
		<?php
	}
?> 