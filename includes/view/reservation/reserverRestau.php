<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	
	if (!auth())
		exit();
	
	$error=true;
	if (isset($_POST["date"]) && isset($_POST["when"]))
	{
		require_once(i("database.class.php"));
		require_once(i("restaurant.class.php"));
		require_once(i("restaurant.controller.class.php"));
		$timestamp=strtotime($_POST["date"]);
		$jour=date("w", $timestamp);
		$heure_debut=19*2+1;
		$heure_fin=24*2;
		if ($_POST["when"]==0)
		{
			$heure_debut=11*2;
			$heure_fin=14*2;
		}
		$db=new Database();
		$db->setOrderCol("nom");
		$db->select("restaurant");
		while ($data=$db->fetch())
		{
			$arrayHO=unserialize($data["heureOuverture"]);
			if (!empty($arrayHO[$jour]))
			{
				$show=false;
				for ($i=$heure_debut;$i<$heure_fin && !$show;$i++)
				{
					if ($arrayHO[$jour][$i%48])
					{
						$show=true;
					}
				}
				if ($show)
				{
					$error=false;
					$photos=array("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzUwMHg1MDAvYXV0bwpDcmVhdGVkIHdpdGggSG9sZGVyLmpzIDIuNi4wLgpMZWFybiBtb3JlIGF0IGh0dHA6Ly9ob2xkZXJqcy5jb20KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28KLS0+PGRlZnM+PHN0eWxlIHR5cGU9InRleHQvY3NzIj48IVtDREFUQVsjaG9sZGVyXzE1YWFhYjUwNjczIHRleHQgeyBmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjVwdCB9IF1dPjwvc3R5bGU+PC9kZWZzPjxnIGlkPSJob2xkZXJfMTVhYWFiNTA2NzMiPjxyZWN0IHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIiBmaWxsPSIjRUVFRUVFIi8+PGc+PHRleHQgeD0iMTg1LjEzMzMzMTI5ODgyODEyIiB5PSIyNjEuNyI+NTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==");
					if (is_array($data["photos"]))
						$photos=explode(",", $data["photos"]);
					?>
					<div class="row featurette">
						<div class="col-md-7 col-md-push-5">
							<h2 class="featurette-heading"><?php echo htmlentities($data["nom"]); ?><p class="pull-right lead">Places : </p></h2>
							<p class="lead"><?php echo htmlentities($data["description"]); ?></p>
							<button type="button" class="btn btn-success pull-right" onclick="alert('Apparition d\'un formulaire pour la date/heure ect..'); return false;">Réserver</button>
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
	<div class="col-lg-6" style="width:100%;" name="form-res" id="form-res">
		<?php if (isset($_POST["date"])) { ?>
			<div class="alert alert-danger" role="alert" name="infoErreur" id="infoErreur">
				Il n'y a auucn restaurant disponible à ce moment.<br/>
			</div>
		<?php } ?>
		<h3>Préparez votre réservation</h3><br/>
		<form role="form"  method="post" id="form_res" name="form_res">
			<div class="form-group">
				<label for="timeStart">Date de réservation</label><br/>
				<input class="form-control" type="text" name="timeStart" id="timeStart" <?php if (isset($_POST["date"])) { ?>value="<?php echo htmlentities($_POST["date"]); ?>"<?php } ?>/> <br/>
				<input type="radio" name="when" id="when" <?php if ((isset($_POST["when"]) && $_POST["when"]==0) ||  date("h")<12) echo "checked"; ?> value="0"> Midi 
				<input type="radio" name="when" id="when" <?php if ((isset($_POST["when"]) && $_POST["when"]==1) ||  date("h")>=12) echo "checked"; ?> value="1"> Soir <br/>
			</div>
		</form>
	</div>
	<script type="text/javascript">
		$("#timeStart").datetimepicker({
			startDate:new Date(),
			format:'d-m-Y',
			timepicker:false,
			onChangeDateTime:function(dp,$input){
				loadToMain("<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], "", i("reserverRestau.php")); ?>", {date : $input.val(), when : $("#when").val()});
			}
		});
		$("#when").click(function(){
			loadToMain("<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], "", i("reserverRestau.php")); ?>", {date : $("#timeStart").val(), when : $("#when").val()});
		});
	</script>
	<?php
	}
?>