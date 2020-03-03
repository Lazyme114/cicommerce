<nav class="breadcrumb" aria-label="breadcrumbs" style="margin-top: 10px;">
	<ul>
		<?php foreach ($breadcrumbs_array as $key => $value): ?>
			<li><a href="<?php echo $key ?>"><?php echo $value; ?></a></li>
		<?php endforeach ?>
		<li class="is-active"><a href="#" aria-current="page"><?php echo $current_page_title; ?></a></li>
	</ul>
</nav>