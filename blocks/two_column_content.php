<?php $settings = get_sub_field('settings') ?>
<?php $span = explode('/', $settings['span']) ?>
<section class="<?php echo $section_class ?>">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell large-<?php echo $span[0] ?> medium-<?php echo $span[0] ?> small-12">
				<article class="content-1">
					<?php the_sub_field('content_1') ?>
				</article>
			</div>

			<div class="cell large-<?php echo $span[1] ?> medium-<?php echo $span[1] ?> small-12">
				<article class="content-2">
					<?php the_sub_field('content_2') ?>
				</article>
			</div>
		</div>
	</div>
</section>
