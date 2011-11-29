$(document).ready(function(){
	$('input[type=submit]').bind('click', function(){
		if($(this).attr('name') == 'delete'){
			if(!confirm('Are you sure you want to delete?')){
				return false;
			}
		}
	})
})