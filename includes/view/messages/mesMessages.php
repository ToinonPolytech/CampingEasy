<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	
	if (!auth())
		exit();
?>
<div class="col-lg-6" style="width:100%;" name="form-connexion" id="form-connexion">
	<h3>Mes conversations</h3>
	<table class='table'>
		<tbody>
			<?php
				$db=new Database();
				$db2=new Database();
				$db->setOrderCol("date");
				$db->setDesc();
				$db->select("messagerie", array("OR" => array("destinataire" => $_SESSION["id"], "expediteur" => $_SESSION["id"])));	
				$array=array();
				while ($data=$db->fetch())
				{
					$idDestinataire=($data["expediteur"]==$_SESSION["id"]) ? $data["destinataire"] : $data["expediteur"];
					if (!in_array($idDestinataire, $array))
					{
						$array[]=$idDestinataire;
						$dernierMessage=$data["message"];
						$date="Le ".date("d/m/Y", $data["date"])." à ".date("H:i:s", $data["date"]);
						$db2->select("users", array("id" => $idDestinataire), array("nom", "prenom"));
						$data2=$db2->fetch();
						$nomDestinataire=$data2["nom"]." ".$data2["prenom"];
						?>
						<tr>
							<td><?php echo htmlentities($nomDestinataire); ?></td>
							<td><?php echo htmlentities($dernierMessage); ?></td>
							<td><?php echo htmlentities($date); ?></td>
							<td><button type="button" class="btn btn-info" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('viewMessage.php')); ?>', {id : <?php echo htmlentities($idDestinataire); ?>});">Répondre</button></td>
						</tr>
						<?php
					}
				}
			?>
		</tbody>
	</table>
</div>