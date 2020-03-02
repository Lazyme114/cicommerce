<h1 class="title">The Blog</h1>
<?php foreach ($latest_blogs->result() as $row):
	$picture = str_replace('.', '_thumb.', $row->picture);
	$image_url = base_url()."uploads/blogs/".$picture;
	$blog_url = base_url()."blog/article/".$row->blog_url;

	?>
	<?php $article_preview = word_limiter($row->blog_content, 25); ?>
	<div class="columns">
		<div class="column is-3">
			<figure class="image is-fullwidth">
				<img class="" src="<?php echo $image_url; ?>" alt="<?php echo $row->blog_title ?>">
			</figure>
		</div>
		<div class="column is-9">
			<h4 class="is-size-4"><?php echo $row->blog_title ?></h4>
			<div class="tags has-addons">
				<span class="tag has-text-black	"><?php echo $row->author; ?> -</span>
				<span class="tag has-text-grey">
					<?php echo date("jS F, Y", strtotime($row->date_published)); ?>
				</span>
			</div>
			<div>
				<?php echo $article_preview; ?>
			</div>
			<p>
				<a href="<?php echo $blog_url; ?>" class="button is-primary is-small is-rounded">Read more...</a>
			</p>
		</div>
	</div>
	<?php endforeach; ?>