<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
date_default_timezone_set('Europe/Paris');
$db= new Database();
$db2= new Database();
if (!isset($_GET["n"]) || !isset($_GET["d"]) || !isset($_GET["y"]))
{
	$x = date("w")-6;
	if ($x<0)
		$x+=7;
	$timeDeb = mktime(0,0,0,date("n"),date("d")-($x)%7,date("y"));
}
else
	$timeDeb = mktime(0,0,0,htmlentities($_GET["n"]),htmlentities($_GET["d"]),htmlentities($_GET["y"]));

$dateDeb = date("d/m/Y", $timeDeb);
$dateFin = date("d/m/Y", $timeDeb+6*3600*24);

?>
<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('ajoutActiviteForm.php')); ?>" class="pull-left">Créer une activité </a>
<div id="titreMois">
    <a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activitesView.php')); ?>?n=<?php echo date("n", $timeDeb-7*3600*24); ?>&d=<?php echo date("d", $timeDeb-7*3600*24); ?>&y=<?php echo date("y", $timeDeb-7*3600*24); ?>"><<</a> Semaine du  : <?php echo $dateDeb; ?> au <?php echo $dateFin; ?> 
	<a href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activitesView.php')); ?>?n=<?php echo date("n", $timeDeb+7*3600*24); ?>&d=<?php echo date("d", $timeDeb+7*3600*24); ?>&y=<?php echo date("y", $timeDeb+7*3600*24); ?>">>></a>
</div>
<?php
	$jourTexte = array('Samedi', 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi');
	switch(date('m'))
	{
		case 1 : $nom_mois = 'Janvier'; break;
		case 2 : $nom_mois = 'Février'; break;
		case 3 : $nom_mois = 'Mars'; break;
		case 4 : $nom_mois = 'Avril'; break;
		case 5 : $nom_mois = 'Mai'; break;
		case 6 : $nom_mois = 'Juin'; break;
		case 7 : $nom_mois = 'Juillet'; break;
		case 8 : $nom_mois = 'Août'; break;
		case 9 : $nom_mois = 'Septembre'; break;
		case 10 : $nom_mois = 'Octobre'; break;
		case 11 : $nom_mois = 'Novembre'; break;
		case 12 : $nom_mois = 'Décembre'; break;
	}
?>
<br/>
<div id="titreMois">
    <strong><?php echo $nom_mois.' '.date('Y'); ?></strong>
</div>
<table class="table table-bordered table-inverse">
	<thead class="thead-inverse">
		<tr>
			<th> </th>
			<?php
			for($k=0;$k<7;$k++)
			{
				?>
					<th <?php if ($timeDeb<=time() && $timeDeb+7*3600*24>=time() && ($k+6)%7==date("w")) { ?>style="background:orange;"<?php } ?>><div><?php echo $jourTexte[$k]." ".date("d", $timeDeb+$k*3600*24); ?></div></th>
				<?php
			}
			?>
		</tr>
		<?php
			for ($h=0;$h<=23;$h++)
			{
			?>
				<tr>
					<th>
						<div><?php echo $h.":00"; ?></div>
					</th>
					<?php
					for ($j=1;$j<=7;$j++)
					{	
						$timeStart=$timeDeb+($j-1)*24*3600+($h)*3600;
						$timeEnd=$timeStart+3599;
						$db->select("activities", array("time_start" => array($timeStart, $timeEnd)));
						$done=false;
						while ($data=$db->fetch())
						{
							if ($db2->getValue("users", array("id" => $data["idDirigeant"]), "access_level")!="CLIENT")
							{
								$done=true;
								?>
								<td><a href='see' onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activiteView.php')); ?>', {id : <?php echo $data["id"]; ?>}); return false;"><?php echo $data["nom"]; ?></a></td>
								<?php
							}
						}
						if (!$done)
							echo "<td></td>";
					}
					?>
				</tr>
			<?php
			}
		?>  
	</thead>
</table>