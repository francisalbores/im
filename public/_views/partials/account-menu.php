<?php $active = 'class="active"'; ?>
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" <?php echo ($page==1) ? $active : ''; ?> ><a href="/admin/account/info">Basic Info</a></li>
	<li role="presentation" <?php echo ($page==2) ? $active : ''; ?> ><a href="/admin/account/security">Security</a></li>
	<li role="presentation" <?php echo ($page==3) ? $active : ''; ?> ><a href="/admin/account/codes">Activation Codes</a></li>
</ul>