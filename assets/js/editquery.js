
function editeme(my_string)
{

    var My_Message = my_string;

        jQuery.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
				action: 'editquery',
				id:My_Message,
				},
				//dataType: 'html',
				success: function(data) {
					var value = data;
	           		var test = value.split('**');
	           		var id= test[0];
	           		var title= test[1];
	           		var timefrom= test[2];
	           		var timeto= test[3];
	           		var speaker= test[4];
	           		var desc= test[5];
	           		var role= test[6];
	           		var room= test[7];
	           		var org= test[8];
	           		var logo= test[9];
	           		var check= test[10];
	           		
					if (check==true){
					jQuery( "#checkbox").prop('checked', true);	
					}
	           	
					jQuery( "#session_id" ).val(id);
					jQuery( "#session_title" ).val(title);
					jQuery( "#session_timefrom" ).val(timefrom);
					jQuery( "#session_timeto" ).val(timeto);
					jQuery( "#session_speaker" ).val(speaker);
					jQuery( "#session_desc" ).val(desc);
					jQuery( "#session_speakerrole" ).val(role);
					jQuery( "#session_room" ).val(room);
					jQuery( "#session_speakerorg" ).val(org);
					jQuery( "#meta_image" ).val(logo);
										
				}
		});
	  
    return false;
}
