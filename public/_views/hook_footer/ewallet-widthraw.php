<script>
$(function () {
	$("#btnsubmit").on('click',function(){
		$(this).replaceWith("<img id='loading' src='<?php echo SITE_URL ?>/assets/img/loading.gif' />");
		var _data = $('form').serialize();
		$.post("<?php echo SITE_URL ?>/admin/ewallet/ajax/send_widthraw_request",_data, function(data){
			data = $.trim(data);
			console.log(data);
			if(data=="1"){								
				Modal.hasHeader = 
				Modal.hasButton = false;
				Modal.addId = "ewallet_modal";
				Modal.contents = "<h1 style='text-align:center;'>Transaction Sucess!</h1>";
				Modal.show($);	
			}
			else{
				alert('Error occured');	
			}
			$("#loading").replaceWith('Thank you for sending your request.');
		});
		return false;
	});
});
</script>