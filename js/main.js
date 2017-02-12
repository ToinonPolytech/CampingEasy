function loadTo(urlCalled, dataUsed, location, type, callback)
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
	});
}
function loadToMain(urlCalled, dataUsed, callback) // dataUsed : { nomVar : valeur, nomVar2 : valeur2 }
{
	loadTo(urlCalled, dataUsed, "#mainAjax", "replace", callback);
}
