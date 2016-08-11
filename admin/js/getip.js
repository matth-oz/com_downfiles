jQuery(document).ready(function(){
    jQuery('.get-ipplace').click(function(event){
         var ip = jQuery(this).text();
         
         var posX = event.pageX;
         var posY = event.pageY;
         
        jQuery.ajax({
           method: 'GET',
           url: 'index.php?option=com_downfiles&task=downfiles.getipinfo',
           dataType: 'json',
           data:{
             ip: ip  
           }
        }).done(function(data){
            var myMap = null;
			var myPlacemark = null;
			
            jQuery("#ipinfo_full").empty();

			if(data.unknown_ip){
				jQuery("#ipinfo_full").html(data.unknown_ip);
				jQuery.fancybox.open(jQuery("#ipinfo_full"));				            
			}
			else{
			 jQuery.fancybox.open(jQuery("#ipinfo_full"));
             myMap = new ymaps.Map("ipinfo_full",{
                   center: [data.lat, data.lon], 
                   zoom: 10,
                   controls: ['zoomControl']
               });
			   
			myPlacemark = new ymaps.Placemark([data.lat, data.lon], { hintContent: data.city, balloonContent: data.city + ', ' + data.country });
			myMap.geoObjects.add(myPlacemark);			
			}
        });
        
        event.preventDefault();
    });
});