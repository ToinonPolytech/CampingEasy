function loadTo(urlCalled, dataUsed, location, type, isImage, callback) // path vers le fichier, voir loadToMain, lieu pour afficher le retour (.class #div ect...), les différents types d'écriture (replace, append, prepend), function à appeller a la fin du call ajax
{
	alert(dataUsed);
	alert(isImage);
	if (typeof isImage =="undefined" || !isImage)
	{
		$params={url:urlCalled, type:"POST", data:dataUsed};
	}
	else
	{
		$params={url: urlCalled,
		type: "POST",
		data: ((window.FormData) ? new FormData($(dataUsed)[0]) : $(dataUsed).serialize()),
		contentType: false,
		processData: false};
	}
	
	$.ajax($params).done(function (data) {
		if (type=="replace")
			$(location).html(data);
		else if (type=="append")
			$(location).append(data);
		else
			$(location).prepend(data);
		
		if (typeof(callback) === "function") { callback(); }
		
		$("a[class!='ajaxed']").click(function(){
			loadToMain($(this).attr("href"), "{}"); return false;
		});
		$("a[class!='ajaxed']").addClass('ajaxed');
	});
}
function loadToMain(urlCalled, dataUsed, callback) // dataUsed : { nomVar : valeur, nomVar2 : valeur2 }
{
	loadTo(urlCalled, dataUsed, "#mainAjax", "replace", false, callback);
}
