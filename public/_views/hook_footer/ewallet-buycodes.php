<!-- start uploader -->
<script src="<?php echo SITE_URL ?>/assets/js/jquery.ui.widget.js"></script>
<script src="<?php echo SITE_URL ?>/assets/js/jquery.iframe-transport.js"></script>
<script src="<?php echo SITE_URL ?>/assets/js/jquery.fileupload.js"></script>

<script>
// FUNCTION for money
Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
    var n = this,
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSeparator = decSeparator == undefined ? "." : decSeparator,
        thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
        sign = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return  'Php ' + sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};
// end

$(function () {

	var url = 'vendor/uploader/';

    // FOR PHOTO
    $('#btnphoto').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
        	$("#photo").val( data.result.file['0'].name );
            var reader = new FileReader();
            reader.readAsDataURL(data.files['0']);
            reader.onload = function (e) {
                $('#photo').parent().hide().parent().find(".upload_prev").attr('src', e.target.result);                
            };
            
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    });

	$("#acc_type, #howmany, #source").change(function(){
		var money = "money";
		var _money = 0;
		if($("#source").val()!="Commission Deduction") {
			$("#agreeNote").html('');
			return false;
		}		
		if($("#acc_type").val() == "Ultimate"){
			_money = <?php echo ULTIMATE_PRICE ?> * $("#howmany").val();
		}
		else if($("#acc_type").val() == "Premier"){
			_money = <?php echo PREMIER_PRICE ?> * $("#howmany").val();
		}
		else if($("#acc_type").val() == "Basic"){
			_money = <?php echo BASIC_PRICE ?> * $("#howmany").val();
		}
		$("#agreeNote").html('This will deduct <strong>'+_money.formatMoney(2,',','.')+'</strong> to your account.');
		$("#amount").val(_money);
	});

	$("#btnsubmit").on('click',function(){
		$(this).replaceWith("<img id='loading' src='<?php echo SITE_URL ?>/assets/img/loading.gif' />");
		var _data = $('form').serialize();
		$.post("<?php echo SITE_URL ?>/admin/ewallet/ajax/use_buycodes",_data, function(data){
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
			$("#loading").replaceWith('Thank you for your transaction.');
		});
		return false;
	});
});
</script>