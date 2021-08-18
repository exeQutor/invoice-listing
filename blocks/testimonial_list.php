<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$the_query = new WP_Query([
	'post_type' => 'testimonial',
	'posts_per_page' => get_sub_field('posts_per_page'),
	'paged' => $paged
]);
?>

<section class="<?php echo $section_class ?>">
	<div class="grid-container">
		<div class="grid-x">
			<?php if ($the_query->have_posts()): ?>
				<?php while ($the_query->have_posts()): $the_query->the_post() ?>
					<div class="cell large-6 medium-6 small-12">
						<article class="text">
							<blockquote>
								<p>“ <?php echo strip_tags(get_the_excerpt(), '<p>') ?> ”</p>
							</blockquote>
							<p class="by-line"><?php the_title() ?></p>
						</article>
					</div>
				<?php endwhile; wp_reset_postdata() ?>
			<?php endif ?>
		</div>
	</div>
</section>

<?php wp_pagenavi(array('query' => $the_query)) ?>
