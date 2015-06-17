var show_loader = function($,element_force_hide){
	var msg =
	'<div class="modal fade" id="loader_modal"> '+
	'		<div class="modal-dialog">'+
	'			<img src="http://inlight.dev/assets/img/loader.gif">'+
	'		</div><!-- /.modal-dialog -->'+
	'	</div>';
	$('body').append(msg);
	$("#loader_modal").modal({
		show 	: true,
		backdrop: 'static',
  		keyboard: true
	});
	if(element_force_hide!=''){
		$(element_force_hide).addClass('tobehind');
	}
	$("#loader_modal").on('hidden.bs.modal', function (e) {
	  $("#loader_modal").remove();
	})
}
var close_loader = function($,element_force_hide){
	setTimeout(function(){
		$("#loader_modal").modal('hide');
		if(element_force_hide!=''){
			$(element_force_hide).removeClass('tobehind');
		}
	},1000)	
}
var Modal = {
	_title : 'Modal Title',
	contents : 'Modal content...',
	hasButton : true,
	hasHeader : true,
	addClass : '',
	addId : 'callinmodal',
	that : null,
	listener : function($){ // not working. not used.
		that = this;
		console.log(that.addId);
		$("#"+that.addId).on('hidden.bs.modal', function (e) {
		  that.destroy($);
		})


	},
	show : function($){
		var element = '<div class="modal fade '+this.addClass+'" id="'+this.addId+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
		  '<div class="modal-dialog">'+
		    '<div class="modal-content">';
		    if(this.hasHeader==true){
		      element +='<div class="modal-header">'+
		        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
		        '<h4 class="modal-title" id="myModalLabel">'+this._title+'</h4>'+
		      '</div>';
		    }
		      
		      element +='<div class="modal-body clearfix">'+
		      this.contents+
		     ' </div>';
		     if(this.hasButton==true){
		        element += '<div class="modal-footer">'+
		        '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
		        '<button type="button" class="btn btn-primary '+this.btnSaveClass+'">Save changes</button>'+
		      '</div>';
		     }
			element += '</div>'+
			  '</div>'+
			'</div>';
			$('body').append( element );
			/*$("#callinmodal").modal('show');*/
			$("#"+this.addId).modal(/*"show"*/{keyboard: false});
			$("#"+this.addId).on('hidden.bs.modal', function (e) {
		  		$("#"+this.addId).remove();
			});
	},
	destroy : function($){
		console.log("destroy");
		that = this;
		setTimeout(function(){
		  $("#"+that.addId).modal('hide');
		},500);
		$("#"+that.addId).on('hidden.bs.modal', function (e) {
		  $("#"+that.addId).remove();
		})
	}
}