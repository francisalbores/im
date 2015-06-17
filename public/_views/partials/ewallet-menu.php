<?php $active = 'class="active"'; ?>
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" <?php echo ($page==0) ? $active : ''; ?> ><a href="/admin/ewallet">Summary</a></li>
	<li role="presentation" <?php echo ($page==1) ? $active : ''; ?> ><a href="/admin/ewallet/widthraw">Widthraw</a></li>
	<li role="presentation" <?php echo ($page==2) ? $active : ''; ?> ><a href="/admin/ewallet/addaccount">Add Personal Account</a></li>
	<li role="presentation" <?php echo ($page==3) ? $active : ''; ?> ><a href="/admin/ewallet/buycodes">Buy Codes</a></li>
</ul>