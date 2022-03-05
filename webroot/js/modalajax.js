   
  function closemodal(){    
    $('#first_modal_box').hide();
    $( "#spinner" ).removeClass( "spinner" );
    $( "body" ).removeClass( "transparent" ); 

  }
  
  function sendajax(theurl){
    $( "#spinner" ).addClass( "spinner" );
    $( "body" ).addClass( "transparent" );
    $.ajax({
		url: theurl,
    type: 'post',
		success: function(response){
      $('#first_modal_box').show();
			$("#first_modal_box").find(".modal-body").html(response);
      $( "#spinner" ).removeClass( "spinner" );		
		}
	});
   
  
  }