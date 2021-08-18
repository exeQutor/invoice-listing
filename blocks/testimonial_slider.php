<?php $the_query = new WP_Query([
	'post_type' => 'testimonial',
	'posts_per_page' => get_sub_field('max_items'),
]) ?>

<section class="<?php echo $section_class ?>" style="background-image: url(<?php echo get_sub_field('background_image')['url'] ?>)">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<h2><?php the_sub_field('heading') ?></h2>

				<?php if ($the_query->have_posts()): ?>
					<div class="slider-list">
						<?php while ($the_query->have_posts()): $the_query->the_post() ?>
							<div class="slider-item">
								<blockquote>
									<p>“ <?php echo strip_tags(get_the_excerpt(), '<p>') ?> ”</p>
								</blockquote>
								<p class="by-line"><?php the_title() ?></p>
							</div>
						<?php endwhile; wp_reset_postdata() ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>
