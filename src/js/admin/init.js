var $url = '/tebfin.co.za/cloudconnect.co.za/website/';

$(document).ready(function(){
	$('input[type=text]').each(function(){
		$(this).attr('autocomplete', 'off');
	})
	
	$(document).slug();
})

$.fn.slug = function(){
	if($('#slug_auto').attr('checked') == undefined && $('#slug_auto').length != 0){
		$('#slug').removeAttr('readonly');
	}
	
	$('#slug_auto').bind('click', function(){//****************************better input event handling (mouse select, click etc)*************//
		if($('#slug').attr('readonly')){
			$('#slug').removeAttr('readonly');
		} else {
			$('#slug').attr('readonly', 'readonly');
			$(document).slugVerify($('#title').val());
		}
	})
	
	$('#title').keyup(function(){
		if($('#slug_auto').attr('checked') != undefined || $('#slug_auto').length == 0){
			$(document).slugVerify($(this).val());
		}
	})
}

$.fn.slugVerify = function($input){
	$xhr = $.getJSON($url + 'json/slug/verify',
		{
			slug : $input,
			id : $('#id').val()
		},
		function($data){
			if($data.inUse){
				$('legend.slug-label').css('color', 'red');
			} else {
				$('legend.slug-label').css('color', '');
			}
			
			$('#slug').attr('value', $data.slug);
		}
	)
}