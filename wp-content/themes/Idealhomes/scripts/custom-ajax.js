jQuery(document).ready(function($) {
    
    
  $('.pagin').click(function() {
	   $('#ajax-loader').show();
    var checkedValues = $('input[name="options[]"]:checked').map(function() {
        return this.value;
    }).get();
    
    console.log(checkedValues);
    var allid= checkedValues.join(', ');
	  console.log(allid);
    var pid= $('#rs').val();
	  console.log(pid);
    
    
   

        $.ajax({
            type: 'POST',
            url: ajax_obj.ajax_url, // Passed from wp_localize_script
            data: {
                action: 'custom_action',
                post_id: allid,
				pid:pid
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
					  $('#ajax-loader').hide();
                    $('#pajax').html(response.content);
                } else {
					 $('#ajax-loader').hide();
                    $('#pajax').html('<p class="ppp">' + response.message + '</p>');
                }
            }
        });
    }); 
	
	 $('.pagin1').click(function() {
	   $('#ajax-loader').show();
    var checkedValues = $('input[name="options[]"]:checked').map(function() {
        return this.value;
    }).get();
    
    console.log(checkedValues);
    var allid= checkedValues.join(', ');
	  console.log(allid);
    var pid= $('#rs').val();
	  console.log(pid);
    
    
   

        $.ajax({
            type: 'POST',
            url: ajax_obj.ajax_url, // Passed from wp_localize_script
            data: {
                action: 'custom_action1',
                post_id: allid,
				pid:pid
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
					  $('#ajax-loader').hide();
                    $('#pajax').html(response.content);
                } else {
					 $('#ajax-loader').hide();
                    $('#pajax').html('<p class="ppp">' + response.message + '</p>');
                }
            }
        });
    }); 
	
	
});
