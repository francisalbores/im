<script>
$(function () {
	$(".item a").on('click',function(){
		console.log($(this).data('id'));
		var _data = "guid="+$(this).data('id');
		$.post("<?php echo SITE_URL ?>/admin/geneology/ajax/gdetail",_data, function(data){
			data = $.trim(data);
			if(data!=false){								
				Modal.hasHeader = 
				Modal.hasButton = false;
				Modal.addId = "geo_modal";			
				Modal.listener($);	
				Modal.contents = data;				
				Modal.show($);			
				$("#"+Modal.addId).on('hidden.bs.modal', function (e) {
				  $("#"+Modal.addId).remove();
				})	
			}
			else{
				alert('Error occured');	
			}
		});
	});
	
});
</script>