function addImage()
{
	$c=$("input[type='file']").length;
	if ($c<=5 && $c>0)
	{
		if ($("#image[rel='"+$c+"']").val()=='')
		{
			$("#image[rel='"+$c+"']").click();
			if ($c<5)
			{
				$("#image[rel='"+$c+"']").after('<input type="file" onchange="imageUpload($(this));" name="image'+parseInt($c+1)+'" id="image" rel="'+parseInt($c+1)+'" accept="image/*" style="display:none;"/><span id="image_preview'+parseInt($c+1)+'"><br/><span class="thumbnail hidden"><img src="http://placehold.it/5" alt=""><span class="caption"><h4></h4><p><button type="button" class="btn btn-default btn-danger" rel="'+parseInt($c+1)+'" onclick="imageButton($(this)); return false;">Annuler</button></p></span></span></span>');
			}
			else
			{
				$("label[for='imageAjax']").hide();
			}
		}
		else
		{
			alert($("#image[rel='1']").val()+" "+$("#image[rel='2']").val()+" "+$("#image[rel='3']").val()+" "+$("#image[rel='4']").val()+$("#image[rel='5']").val());
			
			if ($("#image[rel='1']").val()=='')
				$("#image[rel='1']").click();
			else if ($("#image[rel='2']").val()=='')
				$("#image[rel='2']").click();
			else if ($("#image[rel='3']").val()=='')
				$("#image[rel='3']").click();
			else if ($("#image[rel='4']").val()=='')
				$("#image[rel='4']").click();
			else if ($("#image[rel='5']").val()=='')
				$("#image[rel='5']").click();
		}
	}
	else
	{
		$("label[for='imageAjax']").after('<input type="file" onchange="imageUpload($(this));" name="image'+parseInt($c+1)+'" id="image" rel="'+parseInt($c+1)+'" accept="image/*" style="display:none;"/><span id="image_preview'+parseInt($c+1)+'"><br/><span class="thumbnail hidden"><img src="http://placehold.it/5" alt=""><span class="caption"><h4></h4><p><button type="button" class="btn btn-default btn-danger" rel="'+parseInt($c+1)+'" onclick="imageButton($(this)); return false;">Annuler</button></p></span></span></span>');
		addImage();
	}
}
function imageUpload(object)
{
	var files = object[0].files;
	if (files.length > 0) {
		
		var file = files[0],
			$image_preview = $('#image_preview'+object.attr('rel'));


		$image_preview.find('.thumbnail').removeClass('hidden');
		$image_preview.find('img').attr('src', window.URL.createObjectURL(file));
		$image_preview.find('h4').html(file.name);
	}
}

function imageButton(object)
{
	$('#image[rel="'+object.attr("rel")+'"]').val('');
	$('#image_preview'+object.attr("rel")).find('.thumbnail').addClass('hidden');
	$("label[for='imageAjax']").show();
}