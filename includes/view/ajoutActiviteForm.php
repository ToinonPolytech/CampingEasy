 

 
 
 <html> 
				Créez votre activité ! 
 <form action="../controller/controllerFormulaire/activite.controllerForm.php" method="post">
<p>
	 Date et heure du début de l'activité <br /> 
    <input type="text" name="timeStart" /> <br />
	Nom de l'activité <br />
	<input type="text" name="nom" /> <br />
	Donnez une description de votre activité <br />
	<textarea name="descriptif" rows="6" cols="30"> 
	</textarea> <br />
	Durée en minutes <br />
	<input type="text" name="duree" /> <br />
	Age minimum pour participer à l'activité <br />
	
	<input type="text" name="ageMin" /> <br />
	Age maximum pour participer à l'activité <br />
	
	<input type="text" name="ageMax" /> <br />
	
	Lieu où se déroule l'activité dans le camping <br />
	Lieu Ponctuel 
	<input type="text" name="lieu" /> <br /> ou  <?php require("/ajoutLieuCommunForm.php"); ?>
	Ou lieu existant : 
	manque menu déroulant pour les lieux <br />
	
	Type d'activité : 
	<select name="type">
    <option value="NORMAL">NORMAL</option>
    <option value="RESERVABLE">RESERVABLE</option>
    <option value="PAYANT">PAYANT</option>
    <option value="RESERVABLE_PAYANT">RESERVABLE PAYANT </option>
</select> <br/> 

	Si réservable : 
	
	
	Nombre de places limites pour l'activité <br />
	<input type="text" name="placesLim" /> <br />
	
	Si payante : 
	Prix de l'activité par personne <br />
	
	<input type="text" name="prix" /> <br />
	
	Points donnés par l'activité si elle est remportée :<br />
	
		<input type="text" name="points" /> <br />
    <input type="submit" value="Créer mon activité " />
	
	
</p>
</form>
 
 
 
 
 </html> 