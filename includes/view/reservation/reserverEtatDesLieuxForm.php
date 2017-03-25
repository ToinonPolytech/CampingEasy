 <?php
if (!isset($_SESSION))
	session_start();

date_default_timezone_set('Europe/Paris');
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i('database.class.php'));
require_once(i('client.class.php'));

if (!auth())
	exit();

$user = new Client($_SESSION['id']); 
$dateDep= date('d/m/Y', $user->getUserInfos()->getTimeDepart());
$debutJournee=strtotime(date('y-m-d', $user->getUserInfos()->getTimeDepart()));
$finJournee=$debutJournee+3600*24;
$db = new Database();
$db2= new Database();
$db->select('reservation',array('type' => 'ETAT_LIEUX', 'time' => array($debutJournee, $finJournee)),"time");
$db2->select('etat_lieux',array('debutTime' => array('>=', $debutJournee), 'finTime' => array('<=', $finJournee)));
$hDispo=array();
$hPrise=array();
while($res=$db->fetch())
{
	if (isset($hPrise[$res['time']]))
		$hPrise[$res['time']]+=1;
	else
		$hPrise[$res['time']]=1;
}
while($edl=$db2->fetch())
{	
	for($i=$edl['debutTime'];$i<=$edl['finTime'];$i+=60*$edl['duree_moyenne'])
	{
		if (isset($hDispo[$i]))
			$hDispo[$i]+=1;
		else
			$hDispo[$i]=1;
	}
}
?>
<div class="col-lg-6" style="width:100%;" name="form-res" id="form-res">
	<h3>Réserver votre état des lieux pour le jour de votre départ, <?php echo $dateDep; ?>.</h3>
	<form role="form"  method="post" id="form_act" name="form_act">
		<div class="form-group">
			<label for="horaire_edl">Crénaux disponibles : </label>
			<select name="horaire_edl" id="horaire_edl" class="form-control">
			<?php 
				foreach ($hDispo as $key => $val)
				{
					if (!isset($hPrise[$key]) || $val-$hPrise[$key]>0)
					{
						echo "<option value='".$key."'>".date("H:i", $key)."</option>"; 
					}
				}
			?>
			</select>
			<button type="button" class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER["DOCUMENT_ROOT"], "", i("reservation.controllerForm.php")); ?>', {nbrPersonnes : 1, type : 'ETAT_LIEUX', id : -1, time : $('#horaire_edl').val()}, '#form-res', 'preprend'); return false;">Réserver</button>
		</div> 
	</form>
</div>