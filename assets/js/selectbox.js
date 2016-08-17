function displayVals() {
  var singleValues = jQuery( "#session_speaker" ).val();
  jQuery.ajax({
			type: 'post',
			url: ajaxurl,		
			data:{
			     	singleValues: singleValues,
			  }, 
			success: function(data) {
			 //alert(singleValues);
	            console.log(singleValues);
	  
        	}
		});

  
}
 
jQuery( "select" ).change( displayVals );
displayVals();