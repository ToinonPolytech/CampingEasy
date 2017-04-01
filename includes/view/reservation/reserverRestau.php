<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	require_once(i("restaurant.class.php"));
	require_once(i("restaurant.controller.class.php"));
	if (!auth())
		exit();
	
	
		
	?>
	<div class="col-lg-6" style="width:100%;" name="form-res" id="form-res">
		<h3>Préparez votre réservation</h3><br/>
		<form role="form"  method="post" id="form_res" name="form_res">
			<div class="form-group">
				<label for="date">Date de réservation</label><br/>
				<input class="form-control" type="text" name="date" id="date" <?php if (isset($_POST["date"])) { ?>value="<?php echo htmlentities($_POST["date"]); ?>"<?php } ?>/> <br/>
				<label for="nbrPersonnes">Nombre de couverts ?</label><br/>
				<input class="form-control" type="number" name="nbrPersonnes" id="nbrPersonnes" value="<?php if (isset($_POST["nbrPersonnes"]) && is_numeric($_POST["nbrPersonnes"])) { echo htmlspecialchars($_POST["nbrPersonnes"]); } else { echo "1"; } ?>" />
				<input type="hidden" name="id" id="id" value="<?php if (isset($_POST["id"])) { echo htmlentities($_POST["id"]); } else { echo "0"; } ?>" />
				<button type="button" class="btn btn-success" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], "", i("reserverRestau.php")); ?>', $('#form_res').serialize()); return false;">Chercher</button>
			</div>
		</form>
	</div>
	<script type="text/javascript">
		$("#date").datetimepicker({
			startDate:new Date(),
			format:'d-m-Y H:i',
			step:30,
			minDate:0
		});
	</script>
	<?php
	if (isset($_POST["date"]) && isset($_POST["nbrPersonnes"]) && is_numeric($_POST["nbrPersonnes"]))
	{
		$error=true;
		$timestamp=strtotime($_POST["date"]);
		$jour=date("w", $timestamp);
		
		$heure=date("H", $timestamp)*2;
		if (date("i", $timestamp)==30) $heure+=1;
		$db=new Database();
		$db->setOrderCol("nom");
		if (isset($_POST["id"]) && $_POST["id"]!=0)
			$db->select("restaurant", array("id" => $_POST["id"]));
		else
			$db->select("restaurant");
		
		$db2=new Database();
		while ($data=$db->fetch())
		{
			$arrayHO=unserialize($data["heureOuverture"]);
			if (!empty($arrayHO[$jour]))
			{
				$show=false;
				if ($arrayHO[$jour][$heure])
				{
					$show=true;
				}
				if ($show)
				{
					$error=false;
					$photos=array("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzUwMHg1MDAvYXV0bwpDcmVhdGVkIHdpdGggSG9sZGVyLmpzIDIuNi4wLgpMZWFybiBtb3JlIGF0IGh0dHA6Ly9ob2xkZXJqcy5jb20KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28KLS0+PGRlZnM+PHN0eWxlIHR5cGU9InRleHQvY3NzIj48IVtDREFUQVsjaG9sZGVyXzE1YWFhYjUwNjczIHRleHQgeyBmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjVwdCB9IF1dPjwvc3R5bGU+PC9kZWZzPjxnIGlkPSJob2xkZXJfMTVhYWFiNTA2NzMiPjxyZWN0IHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIiBmaWxsPSIjRUVFRUVFIi8+PGc+PHRleHQgeD0iMTg1LjEzMzMzMTI5ODgyODEyIiB5PSIyNjEuNyI+NTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==");
					if (is_array($data["photos"]))
						$photos=explode(",", $data["photos"]);
					
					$capacite=htmlentities($data["capacite"])-$db2->count("reservation", array("type" => "RESTAURANT", "time" => array($timestamp-3600, $timestamp)));
					
					if ($capacite>=$_POST["nbrPersonnes"])
					{
						?>
						<div class="row featurette">
							<div class="col-md-7 col-md-push-5">
								<h2 class="featurette-heading"><?php echo htmlentities($data["nom"]); ?><p class="pull-right lead">Places : <?php echo $capacite; ?></p></h2>
								<p class="lead"><?php echo htmlentities($data["description"]); ?></p>
								<button type="button" class="btn btn-success pull-right" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reservation.controllerForm.php')); ?>', {nbrPersonnes : <?php echo htmlspecialchars($_POST["nbrPersonnes"]); ?>, type : 'RESTAURANT', id : <?php echo $data["id"]; ?>, time : <?php echo $timestamp; ?>}, '#form-res', 'prepend'); return false;">Réserver</button>
							</div>
							<div class="col-md-5 col-md-pull-7">
								<img style="border:1px solid black;"class="featurette-image img-responsive center-block" width="250" height="250"  alt="250x250" src="<?php echo $photos[0]; ?>" />
							</div>
						</div>
						<?php
					}
				}
			}
		}
		if ($error)
		{
			?>
			<div class="alert alert-danger" role="alert" name="infoErreur" id="infoErreur">
				Il n'y a aucun restaurant disponible à ce moment.<br/>
			</div>
			<?php
		}
	}
	elseif (isset($_POST["id"]))
	{
		$db=new Database();
		$db->select("restaurant", array("id" => $_POST["id"]));
		$data=$db->fetch();
		$photos=array("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzUwMHg1MDAvYXV0bwpDcmVhdGVkIHdpdGggSG9sZGVyLmpzIDIuNi4wLgpMZWFybiBtb3JlIGF0IGh0dHA6Ly9ob2xkZXJqcy5jb20KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28KLS0+PGRlZnM+PHN0eWxlIHR5cGU9InRleHQvY3NzIj48IVtDREFUQVsjaG9sZGVyXzE1YWFhYjUwNjczIHRleHQgeyBmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjVwdCB9IF1dPjwvc3R5bGU+PC9kZWZzPjxnIGlkPSJob2xkZXJfMTVhYWFiNTA2NzMiPjxyZWN0IHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIiBmaWxsPSIjRUVFRUVFIi8+PGc+PHRleHQgeD0iMTg1LjEzMzMzMTI5ODgyODEyIiB5PSIyNjEuNyI+NTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==");
		if (is_array($data["photos"]))
			$photos=explode(",", $data["photos"]);
		$capacite=htmlentities($data["capacite"]);
		?>
		<div class="row featurette">
			<div class="col-md-7 col-md-push-5">
				<h2 class="featurette-heading"><?php echo htmlentities($data["nom"]); ?><p class="pull-right lead">Places : <?php echo $capacite; ?></p></h2>
				<p class="lead"><?php echo htmlentities($data["description"]); ?></p>
				<button type="button" class="btn btn-success pull-right" onclick="return false;">Réserver</button>
			</div>
			<div class="col-md-5 col-md-pull-7">
				<img style="border:1px solid black;"class="featurette-image img-responsive center-block" width="250" height="250"  alt="250x250" src="<?php echo $photos[0]; ?>" />
			</div>
		</div>
		<?php
	}
		
?>