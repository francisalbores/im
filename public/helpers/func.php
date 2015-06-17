<?php
class Func {
	function __construct(){}
	public static function to_money($value){
		return CURRENCY . ' ' . number_format($value,2);
	}
	public static function under_construction(){
		?>
		<div style="text-align:center;">
			<i class="fa fa-gavel" style="font-size:100px;"></i>
			<h1>Under Construction!</h1>
			<p>This place is still under construction. <br />Sorry for the inconvinience.</p>
		</div>
		<?php
	}
}