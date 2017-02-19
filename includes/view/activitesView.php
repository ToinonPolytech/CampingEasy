<?php
require_once("/../modele/database.class.php");


$jour = date("w");
echo 'jour courant : '.$jour.'<br/>';


$database= new Database();

$database->select("activities",NULL,NULL);

echo date("d/m/y H:i", 1487080800);
 
$num=0;
 
$dateDebSemaine = date("Y-m-d", mktime(0,0,0,date("n"),date("d")-$jour+1,date("y")));
$dateFinSemaine = date("Y-m-d", mktime(0,0,0,date("n"),date("d")-$jour+7,date("y")));
     
$dateDebSemaineFr = date("d/m/Y", mktime(0,0,0,date("n"),date("d")-$jour+1,date("y")));
$dateFinSemaineFr = date("d/m/Y", mktime(0,0,0,date("n"),date("d")-$jour+7,date("y")));
 
echo '<div id="titreMois">
    <a href=""><<</a> Semaine du  : '.$dateDebSemaineFr.' au '.$dateFinSemaineFr.' <a href="">>></a>
</div> ';
 
 
$jourTexte = array('',1=>'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'Samedi', 'Dimanche');
$plageH = array(1=>'8:00','9:00','10:00','11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00');
 
$nom_mois = date('F');
 
switch($nom_mois)
{
    case 'Junuary' : $nom_mois = 'Janvier'; break;
    case 'February' : $nom_mois = 'Février'; break;
    case 'March' : $nom_mois = 'Mars'; break;
    case 'April' : $nom_mois = 'Avril'; break;
    case 'May' : $nom_mois = 'Mai'; break;
    case 'June' : $nom_mois = 'Juin'; break;
    case 'July' : $nom_mois = 'Juillet'; break;
    case 'August' : $nom_mois = 'Août'; break;
    case 'September' : $nom_mois = 'Septembre'; break;
    case 'October' : $nom_mois = 'Otober'; break;
    case 'November' : $nom_mois = 'Novembre'; break;
    case 'December' : $nom_mois = 'Décembre'; break;
 
}
 
echo '<br/>
<div id="titreMois">
    <strong>'.$nom_mois.' '.date('Y').'</strong>
</div>';
 
echo '<table class="table table-bordered table-inverse">
  <thead class="thead-inverse">';
 
    // en tête de colonne
    echo '<tr>';
    for($k = 0; $k < 8; $k++)
    {
        if($k==0)
            echo '<th>'.$jourTexte[$k].'</th>';
        else
            echo '<th><div>'.$jourTexte[$k].' '.date("d", mktime(0,0,0,date("n"),date("d")-$jour+$k,date("y"))).'</div></th>';
         
    }
    echo '</tr>';
 
    // les 2 plages horaires : matin - midi
	
	
    for ($h = 1; $h <= 13; $h++)
    { //pour toute les heures de la journée 
        echo '<tr>
        <th>
            <div>'.$plageH[$h].'</div>
        </th>';
 
        // les infos pour chaque jour
            for ($j = 1; $j < 8; $j++)
            {	
				while ($act=$database->fetch()) //pour chaque activité 
						
				
					{ 	if(date("w",$act['time_start']) == $j)
						{ //si elle tombe le même jour 
							
							
							$time= $act['time_start'];
							echo date("H:i",$time);
							
						if(date("H:i",$act['time_start'])== $plageH[$h])
							{ //et la même heure 
								echo 'heure bonne';
								echo '<td>'.$act['nom'].'<td>'; //affiche l'activité à sa place 
							
							}	
						}
						else 
						{
							echo '<td> </td>';
							
						}
					
					
						
					}
					
					echo '<td>
                </td>';
				}
                
            }
           
echo '</table>';
?>