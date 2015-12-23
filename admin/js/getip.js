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
            jQuery("#ipinfo_full").empty();
            jQuery.fancybox.open(jQuery("#ipinfo_full"));
             myMap = new ymaps.Map("ipinfo_full",{
                   center: [data.lat, data.lon], 
                   zoom: 10,
                   controls: ['zoomControl']
               });                    
        });
        
        event.preventDefault();
    });
});