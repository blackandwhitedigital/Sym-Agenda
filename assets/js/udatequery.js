function updateeme(my_string)
{

    var My_Message = my_string;

        jQuery.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
				action: 'update_query',
				id:My_Message,
				},
				dataType: 'html',
				success: function(response) {
				location.reload();
				}
		});
	  
    return false;
}