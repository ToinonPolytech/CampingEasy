<?php
require_once("/../modele/database.class.php");
$db= new Database();
$timeDeb=mktime(0,0,0,date("n"),date("d")-date("w")+1,date("y"));
$dateDeb = date("d/m/Y", $timeDeb);
$dateFin = date("d/m/Y", mktime(0,0,0,date("n"),date("d")-date("w")+7,date("y")));
?>
<div id="titreMois">
    <a href=""><<</a> Semaine du  : <?php echo $dateDeb; ?> au <?php echo $dateFin; ?> <a href="">>></a>
</div>
<?php
	$jourTexte = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
	$plageH = array('8:00','9:00','10:00','11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00');
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
					<th <?php if ($k==date("w")-1) { ?>style="background:orange;"<?php } ?>><div><?php echo $jourTexte[$k]." ".date("d", mktime(0,0,0,date("n"),date("d")-date("w")+$k+1,date("y"))); ?></div></th>
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
						?>
						<td>
							<?php
								$timeStart=$timeDeb+($j-1)*24*3600+$h*3600;
								$timeEnd=$timeStart+3599;
								$db->select("activities", array("time_start" => array($timeStart, $timeEnd)));
								while ($data=$db->fetch())
								{
									echo "une activité a été detectée";
								}
							?>
						</td>
						<?php
					}
					?>
				</tr>
			<?php
			}
		?>  
	</thead>
</table>