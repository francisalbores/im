<?php
include_once('admin.php');
class Geneology extends Admin{
	function FIRST(){
		$this->graphical();		
	}
	public static function echo_box($uID_avatar, $uID){
		?>
		<div class="box">
			<?php if(isset($uID_avatar)) : ?>
				<a data-id="<?php echo $uID ?>">
					<img src="<?php echo SITE_URL ?>/uploads/thumbnail/<?php echo $uID_avatar ?>" />
				</a>
			<?php else : ?>
				n/a
			<?php endif; ?>
		</div>
		<?php
	}
	function graphical(){		
		Load::model('geology');
		$Geology = new Geology();
		
		// for dynamic network
		$afid = (isset($_GET['afid'])) ? $this->encrypt_decrypt('decrypt',$_GET['afid']) : "";		
		$result = $Geology->get_tree($afid);
		Load::view('geneology-graphical',$result);
		Load::hook_js('modal');
		Load::hook_css('geology');
		Load::hook_footer('geo-graphical');
	}
	private function encrypt_decrypt($action, $string) {
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = SECRET_KEY;
	    $secret_iv = SECRET_IV;

	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}
	function gdetail(){

		Load::model('geology');
		$Geology = new Geology();
		$result = $Geology->get_detail($_REQUEST['guid']);
		?>
		<center><h4>User Detail</h4></center>
		<hr />
		<div class="row">
			<div class="col-md-6">
				<img src="<?php echo SITE_URL .'/uploads/'. $result['photo'] ?>" style="width:100%;" />
			</div>
			<div class="col-md-6">
				<table class="table">
					<tr>
						<th>User ID</th>
						<td><?php echo $result['ID'] ?></td>
					</tr>
					<tr>
						<th>Name</th>
						<td><?php echo $result['name'] ?></td>
					</tr>
					<tr>
						<th>Username</th>
						<td><?php echo $result['username'] ?></td>
					</tr>
					<tr>
						<th>Mobile</th>
						<td><?php echo $result['mobile'] ?></td>
					</tr>
					<tr>
						<th>Type</th>
						<td><?php echo $result['_type'] ?></td>
					</tr>
				</table>
				<a class="btn btn-primary" href="<?php echo SITE_URL ?>/admin/geneology/graphical/<?php echo $this->encrypt_decrypt('encrypt',$result['ID']) ?>">View Network</a>
			</div>
		</div>		
		<?php 
		exit();
	}
	function textual(){
		Load::model('geology');
		$Geology = new Geology();
		$result = $Geology->get_summary();
		Load::view('geneology-textual',$result);
	}
}