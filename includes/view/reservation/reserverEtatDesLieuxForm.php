 <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i('database.class.php'));
	require_once(i('client.class.php'));
	
	if (!auth())
		exit();
	
	$user = new Client($_SESSION['id']); 
	$dateDep= date('d/m/y',$user->getUserInfos()->getTimeDepart());
	echo $dateDep;
	$db = new Database();
	$db2= new Database();
	$db->select('reservation',array('type' => 'etat_lieux','time' => array('>=',time())));
	$db2->select('etat_lieux',array('debutTime' => array('>=',time())));
	$hDispo=array();
	$hPrise=array();
	while($res=$db->fetch())
	{
		if(date('d/m/y',$res['time'])==$dateDep)
		{
			$hPrise[]=$res['time'];
		}
	}
	while($edl=$db2->fetch())
	{	if(date('d/m/y',$edl['debutTime'])==$dateDep)
		{	
			 
			for($i=$edl['debutTime'];$i<=$edl['finTime'];$i=$i+60*$edl['duree_moyenne'])
			{
				for($j=0;$j<sizeof($hPrise);$j++)
				{
					if($edl['debutTime']+$i!=$hPrise[$j])
					{
						$hDispo[]=$edl['debutTime'];
					}
				}
			}
		}
	}
	$hDispoU = array_unique($hDispo);
	?>
	
	<div class="col-lg-6" style="width:100%;" name="form-res" id="form-res">
	<form role="form"  method="post" id="form_act" name="form_act" enctype="multipart/form-data">
		<div class="form-group">
			<select>
			<?php 
				for($i=1;$i<sizeof($hDispoU);$i++)
				{	echo $hDispoU[$i];
					?>
					<option><?php echo date('H:m',$hDispoU[$i]);?> </option> 
					<?php
				}
				?>
			</select>
			
		</div> 
	</form>
	</div>
	
		