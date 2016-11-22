// JavaScript Document

jQuery.fn.editTodo = function(){
	$(this).click(function(){
		$(this).addClass('TodoTextEdit');
	});
	$(this).blur(function(){
		$(this).removeClass('TodoTextEdit');
	});
}

jQuery.fn.toggleComplete = function(){
	$(this).click(function(){
		var Item = $(this).parent().parent().parent();
		var ItemId = $(this).parent().parent().attr('id');
		var Status = Item.parent().parent().attr('class');
		var Location = ($(this).hasClass('CheckBoxChecked'))?'Incomplete':'Complete';
		
		$('.'+Location).append(Item);
		
		if($(this).hasClass('CheckBoxChecked'))
			$(this).removeClass('CheckBoxChecked');
		else
			$(this).addClass('CheckBoxChecked');
			
		
		//UNBIND METHODS?
		$('.Incomplete, .Complete').unbind(function(){
			$('.Incomplete, .Complete').sortable('refresh');
			$('.Incomplete, .Complete').sortable('refreshPosition');
	
			$('.Incomplete, .Complete').sortable({ opacity: 0.8, cursor: 'move', update: function(e, ui) {
					var str = '';
					
					$(this).find('.TodoItem').each(function(i){
						str += (str.length>0)?'&':'';
						str += $(this).attr('id')+'='+i;
					});
					alert(str);
																						 
				}
			});
			
		});
		
		//REATTACH SORTABLE METHODS SHOULD CAUSE IT TO RECALCULATE?	
			
			
	});
}