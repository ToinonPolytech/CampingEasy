function loadTo(urlCalled, dataUsed, location, type, isImage, callback) // path vers le fichier, voir loadToMain, lieu pour afficher le retour (.class #div ect...), les différents types d'écriture (replace, append, prepend), function à appeller a la fin du call ajax
{
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
	if (document.location==urlCalled)
		window.history.replaceState($params.data, 'void', "index.php?p");
	else
		window.history.pushState($params.data, 'void', "index.php?p");
	
	$.ajax($params).done(function (data) {
		if (type=="replace")
			$(location).html(data);
		else if (type=="append")
			$(location).append(data);
		else if (type=="next")
			$(location).next(data);
		else if (type=="before")
			$(location).before(data);
		else
			$(location).prepend(data);
		
		if (typeof(callback) === "function") { callback(); }
		$("a").each(function(){
			if (!$(this).hasClass("ajaxed"))
			{
				$(this).attr('rel', $(this).attr('href'));
				$(this).attr('href', '');
				$(this).addClass('ajaxed');
				$(this).click(function(){
					loadToMain($(this).attr("rel"), "{}"); return false;
				});
			}
		});
	});
}
function loadToMain(urlCalled, dataUsed, callback) // dataUsed : { nomVar : valeur, nomVar2 : valeur2 }
{
	loadTo(urlCalled, dataUsed, "#mainAjax", "replace", false, callback);
}
