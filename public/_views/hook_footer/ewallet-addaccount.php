<script>
$(function () {
	$("#acc_type").change(function(){
		var money = "money";
		var _money = 0;
		console.log($(this).val());
		if($(this).val() == "Ultimate"){
			money = "<?php echo Func::to_money(ULTIMATE_PRICE) ?>";
			_money = "<?php echo ULTIMATE_PRICE ?>";
		}
		else if($(this).val() == "Premier"){
			money = "<?php echo Func::to_money(PREMIER_PRICE) ?>";
			_money = "<?php echo PREMIER_PRICE ?>";
		}
		else if($(this).val() == "Basic"){
			money = "<?php echo Func::to_money(BASIC_PRICE) ?>";
			_money = "<?php echo BASIC_PRICE ?>";
		}
		$("#agreeNote").html('This will deduct <strong>'+money+'</strong> to your account.');
		$("#amount").val(_money);
	});

	$("#btnsubmit").on('click',function(){
		$(this).replaceWith("<img id='loading' src='<?php echo SITE_URL ?>/assets/img/loading.gif' />");
		var _data = $('form').serialize();
		$.post("<?php echo SITE_URL ?>/admin/ewallet/ajax/use_addaccount",_data, function(data){
			data = $.trim(data);
			console.log(data);
			if(data=="1"){								
				Modal.hasHeader = 
				Modal.hasButton = false;
				Modal.addId = "ewallet_modal";
				Modal.contents = "<h1 style='text-align:center;'>Transaction Sucess!</h1>";
				Modal.show($);	
			}
			else if(data=="USER-MAX"){
				Modal.hasHeader = 
				Modal.hasButton = false;
				Modal.addId = "ewallet_modal";
				Modal.contents = "<h3 style='text-align:center;'>Error : You already reach the maximum number accounts. <br />"+
								"<small><a href='<?php echo SITE_URL ?>/admin/ewallet/addaccount'>Try Again</a></small></h3>";
				Modal.show($);	
			}
			else if(data=="CROSSLINE"){
				Modal.hasHeader = 
				Modal.hasButton = false;
				Modal.addId = "ewallet_modal";
				Modal.contents = "<h3 style='text-align:center;'>Error : Crossline is prohibited. <br />"+
								"<small><a href='<?php echo SITE_URL ?>/admin/ewallet/addaccount'>Try Again</a></small></h3>";
				Modal.show($);	
			}
			else if(data=="OCCUPIED"){
				Modal.hasHeader = 
				Modal.hasButton = false;
				Modal.addId = "ewallet_modal";
				Modal.contents = "<h3 style='text-align:center;'>Error : Position Occupied. This placement position is already occupied by someone else. Please consult your sponsor for the correct placement ID and position.<br />"+
								"<small><a href='<?php echo SITE_URL ?>/admin/ewallet/addaccount'>Try Again</a></small></h3>";
				Modal.show($);	
			}
			else{
				alert('Error occured');	
			}
			$("#loading").replaceWith('Thank you for your transaction.');
		});
		return false;
	});
});
</script>