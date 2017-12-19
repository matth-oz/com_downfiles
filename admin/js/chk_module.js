jQuery(document).ready(function(){
    
	var $ = jQuery;
	$('.module-link').on('click', function(){
		
		var recId = $(this).data('id');
		var action, url;	
		
		if($(this).val() == 0){
			// показываем ссылку в модуле
			action = 'enable_link';
			url = 'index.php?option=com_downfiles&task=downfiles.operateonlink&action='+action;			
		}
		else{
			// отключаем показ ссылки в модуле
			action = 'disable_link';
			url = 'index.php?option=com_downfiles&task=downfiles.operateonlink&action='+action;
		}
		
		$.ajax({
           method: 'GET',
           url: url,
           dataType: 'json',
           data:{
             recId: recId  
           }
        }).done(function(data){
          if(data.result == 'success'){
			  if(action == 'enable_link'){
				$(this).val('0');
				$(this).text('Скрыть из модуля');
			  }
			  else{
				$(this).val('1');
				$(this).text('Показать в модуле');
			  }
		  }
		  else{
			  alert('неудача!');
		  }
        });		
	});	
});