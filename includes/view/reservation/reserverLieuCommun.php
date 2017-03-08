<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	
	if (!auth())
		exit();

	
	require_once(i("database.class.php"));
	require_once(i("user.class.php"));
	
	$user=new User($_SESSION["id"]);
	$time_depart=time()+3600*24*31-12;
	if ($user->getUserInfos()->getTimeDepart()>0)
		$time_depart=$user->getUserInfos()->getTimeDepart();
	
	$db=new Database();
	$db->select("lieu_commun", array("debutReservation" => array("OR", array("<=", time()), array("=", "0")), "finReservation" => array("OR", array(">", $time_depart), array("=", "0"))));
	while ($data=$db->fetch())
	{
		$photos=array("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzUwMHg1MDAvYXV0bwpDcmVhdGVkIHdpdGggSG9sZGVyLmpzIDIuNi4wLgpMZWFybiBtb3JlIGF0IGh0dHA6Ly9ob2xkZXJqcy5jb20KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28KLS0+PGRlZnM+PHN0eWxlIHR5cGU9InRleHQvY3NzIj48IVtDREFUQVsjaG9sZGVyXzE1YWFhYjUwNjczIHRleHQgeyBmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjVwdCB9IF1dPjwvc3R5bGU+PC9kZWZzPjxnIGlkPSJob2xkZXJfMTVhYWFiNTA2NzMiPjxyZWN0IHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIiBmaWxsPSIjRUVFRUVFIi8+PGc+PHRleHQgeD0iMTg1LjEzMzMzMTI5ODgyODEyIiB5PSIyNjEuNyI+NTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==");
		if (is_array($data["photos"]))
			$photos=explode(",", $data["photos"]);
?>
<div class="row featurette">
	<div class="col-md-7 col-md-push-5">
		<h2 class="featurette-heading"><?php echo htmlentities($data["nom"]); ?><p class="pull-right lead">??€ <br/> Disponible : ??</p></h2>
		<p class="lead"><?php echo htmlentities($data["description"]); ?></p>
		<button type="button" class="btn btn-success pull-right" onclick="alert('Apparition d\'un formulaire pour la date/heure ect..'); return false;">Réserver</button>
	</div>
	<div class="col-md-5 col-md-pull-7">
		<img style="border:1px solid black;"class="featurette-image img-responsive center-block" width="250" height="250"  alt="250x250" src="<?php echo $photos[0]; ?>" />
	</div>
</div>
<?php
	}
?>