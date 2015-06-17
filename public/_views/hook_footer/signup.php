<link rel="stylesheet" href="<?php echo SITE_URL ?>/assets/css/signup.css" />

<!-- start uploader -->
<script src="<?php echo SITE_URL ?>/assets/js/jquery.ui.widget.js"></script>
<script src="<?php echo SITE_URL ?>/assets/js/jquery.iframe-transport.js"></script>
<script src="<?php echo SITE_URL ?>/assets/js/jquery.fileupload.js"></script>
<script>
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

    // FOR RECEIPT
    $('#btnpayment_receipt').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $("#payment_receipt").val( data.result.file['0'].name );
            var reader = new FileReader();
            reader.readAsDataURL(data.files['0']);
            reader.onload = function (e) {
                $('#payment_receipt').parent().hide().parent().find(".upload_prev").attr('src', e.target.result);                
            };
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress2 .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    });

});
</script>
<!-- end -->