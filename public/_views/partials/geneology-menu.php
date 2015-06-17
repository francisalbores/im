<?php $active = 'class="active"'; ?>
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" <?php echo ($page==1) ? $active : ''; ?> ><a href="/admin/geneology/graphical">Graphical</a></li>
	<li role="presentation" <?php echo ($page==2) ? $active : ''; ?> ><a href="/admin/geneology/textual">Textual</a></li>
</ul>