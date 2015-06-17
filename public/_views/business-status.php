<style>
#content{
	margin-left: 200px;
}
</style>
<div id="content">

	<h3>Company Business Status</h3>

	<strong>Total Income : <?php echo Func::to_money($income) ?></strong><br />
	<strong>Total Expense : <?php echo Func::to_money($expense) ?></strong><br />
	<hr />
	<strong>Company Cash On Hand : <?php echo Func::to_money($onhand) ?></strong><br />
	<strong>Affiliate Amount : <?php echo Func::to_money($aff_money) ?></strong><br />
</div>