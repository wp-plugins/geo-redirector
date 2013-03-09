// JavaScript Document

<?php

include('../../../../wp-blog-header.php');



?>



function redirectclient() {

    var loc = {}; var clientlatlng; var clientaddress ; var data_arry = {};

    var geocoder = new google.maps.Geocoder();

    if(google.loader.ClientLocation) {

        loc.lat = google.loader.ClientLocation.latitude;

        loc.lng = google.loader.ClientLocation.longitude;

		data_arry['latitude'] = loc.lat;

				data_arry['longitude'] = loc.lng;

                

        clientlatlng = new google.maps.LatLng(loc.lat, loc.lng);

       /* geocoder.geocode({'latLng': latlng}, function(results, status) {

            if(status == google.maps.GeocoderStatus.OK) {

               clientaddress = results[0]['formatted_address'];

                data_arry['address'] = clientaddress;

            };

        });*/

    }

    

    var redirectURL = '';var  currentURL = '';

    var homepage_url = "<?php echo get_site_url(); ?>";

    $.ajax({

       type: "POST",

       url: "<?php echo plugins_url().'/geo-redirector/get_alllocations.php'; ?>",

       dataType:"json",      

       success: function(data){
   				var prev_distance = 0;
               	$.each(data,function()
                {
                    var current_loc = new google.maps.LatLng(this.latitude,this.longitude);
                    var distance = google.maps.geometry.spherical.computeDistanceBetween(clientlatlng, current_loc);
                    if(distance < (this.radius * 1000) && this.isnot == 'No')
                        {
                            if(prev_distance  >= distance || prev_distance  ==0)
                            {
                                if(this.cur_url != null)
                                currentURL = this.cur_url; 
                                else 
                                currentURL ='';
                                if(currentURL == '' && (homepage_url == window.location || homepage_url+'/' == window.location))
                                    { redirectURL = this.red_url; }
                                else if( currentURL != '' && ( currentURL == window.location || currentURL+'/' == window.location)) 
                                    { redirectURL = this.red_url;}
                                prev_distance = distance;
                         	}
						}
                
                if (distance > (this.radius * 1000) && this.isnot == 'Yes')
				{
                	if(prev_distance  < distance || prev_distance  ==0)
                	{
                       	if(this.cur_url != null)
                       		currentURL = this.cur_url; 
                            else 
                           	currentURL ='';
						if(currentURL == '' && (homepage_url == window.location || homepage_url+'/' == window.location))
                        { redirectURL = this.red_url; }
                        else if( currentURL != '' && ( currentURL == window.location || currentURL+'/' == window.location)) 
                        { redirectURL = this.red_url;}

                        prev_distance = distance;
                     }
                 }
               }
             );

              data_arry['url'] = window.location.href;

               data_arry['red_url'] = redirectURL;

               

			$.ajax({
      			type: "get",
		       	url: "http://anushkar.com/saveclientloc.php",
				data:data_arry,
				dataType:"jsonp",       
				success: function(msg){
				alert( msg );
			   },
		       error : function(msg){
		      	if(redirectURL != ''){   
				window.location = redirectURL;
	    		}
				}
			   });
               },
		error: function(msg){
                  // 	alert(msg);
                    }
                    
         });
         }
redirectclient();