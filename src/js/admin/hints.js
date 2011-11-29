$(window).bind('load',function(){
	$hints = {title : 'The main title for the article',
			slug : 'The search engine friendly URL name for the article. If "Auto create" is ticked this URL will be created for you using the title.',
			copy : 'Main textual content for article.',
			linkedto : 'This is a list of articles that you can link the current article to. The selected item in this list will then be the parent of the current article.'};
	
	$(document).hints($hints);
})

$.fn.hints = function($hints){
	$offset = 10;
	
	$('body').prepend('<div id="hint"></div>');
	$('#hint').css('position', 'absolute').css('background', '#fff').css('border', '1px solid #eee').css('width', 150).css('text-align', 'justify').css('padding', 5).hide();
	
	for($val in $hints){
		$label = $('.' + $val + '-label');
		$label.addClass('help');
		
		$label.mouseenter(
				{id : $val},
				
				function(event){
					$('#hint').text($hints[event.data.id]).show();
					
					$(document).reposition(event);
				}
		)
		
		$label.mouseleave(function(){
			$('#hint').hide();
		})
	}
	
	$('body').mousemove(function(event){
		$(document).reposition(event);
	})
}

$.fn.reposition = function(event){
	$('#hint').css('margin-left', (event.pageX + $offset)).css('margin-top', (event.pageY + $offset));
}