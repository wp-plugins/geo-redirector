// JavaScript Document

<?php

include('../../../../wp-blog-header.php');



?>





function mapinitialize(var_lat,var_long,locname) {



	var myLatlng =  new google.maps.LatLng(var_lat,var_long)

	

  var myOptions = {

    zoom: 8,

    draggable:true,

    center: myLatlng,

    mapTypeId: google.maps.MapTypeId.ROADMAP

  }

  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

  

  var marker = new google.maps.Marker({

      position: myLatlng,

      map: map,

      title:locname

  });

}





function get_langlongfromaddress(var_address){



 geocoder = new google.maps.Geocoder();



      if (geocoder) {

         geocoder.geocode({ 'address': var_address }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

             // console.log(results[0].geometry.location);

              

              jQuery('input[name=latitude]').val(results[0].geometry.location.lat());

              jQuery('input[name=longitude]').val(results[0].geometry.location.lng());

				jQuery('#formatted_address').val( results[0].formatted_address);
              

              mapinitialize(results[0].geometry.location.lat(),results[0].geometry.location.lng(),results[0].formatted_address );

              

            } 

            else {

              //console.log('No results found: ' + status);

            }

         });

      }



	

}





function edit_georecord(var_id){

var $values = ''; var $counter = 0;

	jQuery('#geo_tatatable tr#tr_'+var_id+' td').each(function(){

    $counter = $counter + 1; if($counter <= 8) {

    		switch($counter){

            case 1 : jQuery('input[name=hid_id]').val(this.innerHTML);break;

            case 2 : {jQuery('input[name=address]').val(this.innerHTML); jQuery('input[name=formatted_address]').val(this.innerHTML);break;}

            case 3 : jQuery('input[name=latitude]').val(this.innerHTML);break;

			case 4 : jQuery('input[name=longitude]').val(this.innerHTML);break;

            case 5 : jQuery('input[name=radius]').val(this.innerHTML);break;

            case 6 : jQuery('input[name=cur_url]').val(this.innerHTML);break;

            case 7 : jQuery('input[name=red_url]').val(this.innerHTML);break;

            case 8 : { if(this.innerHTML == 'Yes') jQuery('input[name=isnot]').prop('checked',true);  else jQuery('input[name=isnot]').prop('checked',false);}break;

            }

    	//$values = $values + '<br/>' + this.innerHTML ; 

        }

    });

    

     mapinitialize(jQuery('input[name=latitude]').val(),jQuery('input[name=longitude]').val(),jQuery('input[name=address]').val() );

    

   // jQuery('#message')[0].innerHTML = '<p> '+$values+' </p>';

    

    jQuery('#btn_cancel').css('display','');

}



function reset_from(){

	jQuery('#geo_submitform :text').each(function(){

    	jQuery(this).val('');

         if(this.type == 'checkbox') this.checked = false;

    });

    

    jQuery('#geo_submitform :checkbox').each(function(){

     this.checked = false;

    });

    

    jQuery('#hid_id').val('');

    

	jQuery('#btn_cancel').css('display','none');

    

}



function validateEmail($email) {

	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	if( !emailReg.test( $email ) ) {

		return false;

	} else {

		return true;

	}

}



function geo_redirect_onsubmit(submitform){





     var _inputs = jQuery('#'+submitform.id+' :input');



    // not sure if you wanted this, but I thought I'd add it.

    // get an associative array of just the values.

    var values = {};

    

    	var validate = true; var errors = new Array();

    _inputs.each(function() {

		if( parseInt(this.className.indexOf('required')) >=0 && jQuery(this).val() == '')

		{  errors.push(this.title + ' is a required field');  validate =false;}

		else

		{	

			if(parseInt(this.className.indexOf(' email')) >=0 && !validateEmail(jQuery(this).val()))

			{errors.push('Invalid email address');  validate =false;}	

			if(this.type == 'radio'){

				values[this.name] = jQuery('input[type="radio"][name="'+this.name+'"]:checked').val();

				}

			else if(this.type == 'checkbox'){values[this.name] = this.checked ? 'Yes' : 'No'; }	

			else

			values[this.name] = jQuery(this).val();

			}

		

    });



    if(validate){

    jQuery.ajax({

       type: "POST",

       url: "<?php echo plugins_url().'/geo-redirector/ajax_functions.php'; ?>",

       data: values ,

       success: function(msg){

   			get_currentdata();

            reset_from();

   			jQuery('#message')[0].innerHTML = '<p> Successfully Update </p>';

            jQuery('#message').addClass('updated');

            jQuery('#message').show();

            jQuery('#message').fadeOut(5000);

   

   

        },

         error: function(msg){

         jQuery('#message')[0].innerHTML = '<p> '+msg+'</p>';

            jQuery('#message').addClass('error');

            jQuery('#message').show();

            jQuery('#message').fadeOut(5000);

            }

     });

     

     }

     else{

     

     	var error_msg = '';

	jQuery.each(errors,function(){ error_msg += this +'<br/>';});

     jQuery('#message')[0].innerHTML = '<p> '+error_msg +'</p>';

            jQuery('#message').addClass('error');

            jQuery('#message').show();

            jQuery('#message').fadeOut(10000);

     

     }

 



	}

    

function get_currentdata(){

	jQuery.ajax({

       type: "POST",

       url: "<?php echo plugins_url().'/geo-redirector/ajax_datadisplay.php'; ?>",      

       success: function(msg){

      			jQuery('#geo_datadisplay')[0].innerHTML = msg;  

        },

         error: function(msg){

         jQuery('#message')[0].innerHTML = '<p> '+msg+'</p>';

            jQuery('#message').addClass('error');

            jQuery('#message').show();

            jQuery('#message').fadeOut(5000);

            }

     });

}    





function delete_georecord(var_id){

	

    jQuery.ajax({

       type: "POST",

       url: "<?php echo plugins_url().'/geo-redirector/ajax_modify.php?action=del&id='; ?>"+var_id,      

       success: function(msg){

      			get_currentdata();

   			jQuery('#message')[0].innerHTML = '<p> Successfully Deleted  </p>';

            jQuery('#message').addClass('updated');

            jQuery('#message').show();

            jQuery('#message').fadeOut(5000);

        },

         error: function(msg){

         jQuery('#message')[0].innerHTML = '<p> '+msg+'</p>';

            jQuery('#message').addClass('error');

            jQuery('#message').show();

            jQuery('#message').fadeOut(5000);

            }

     });



}