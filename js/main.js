function loadTo(urlCalled, dataUsed, location, type, callback) // path vers le fichier, voir loadToMain, lieu pour afficher le retour (.class #div ect...), les différents types d'écriture (replace, append, prepend), function à appeller a la fin du call ajax
{
	$.ajax({
		url: urlCalled,
		type: "POST",
		data: dataUsed
	}).done(function (data) {
		if (type=="replace")
			$(location).html(data);
		else if (type=="append")
			$(location).append(data);
		else
			$(location).prepend(data);
		
		if (typeof(callback) === "function") { callback(); }
		
		$("a").click(function(){
			loadToMain($(this).attr("href"), "{}"); return false;
		});
	});
}
function loadToMain(urlCalled, dataUsed, callback) // dataUsed : { nomVar : valeur, nomVar2 : valeur2 }
{
	loadTo(urlCalled, dataUsed, "#mainAjax", "replace", callback);
}
