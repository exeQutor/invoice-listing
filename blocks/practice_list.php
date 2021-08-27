<?php $the_query = new WP_Query([
	'post_type' => 'practice',
	'posts_per_page' => -1,
]) ?>

<section class="<?php echo $section_class ?>">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<header class="heading">
					<h4><?php the_sub_field('subheading') ?></h4>
					<h2><?php the_sub_field('heading') ?></h2>
					<p><?php the_sub_field('text') ?></p>
				</header>

				<?php if ($the_query->have_posts()): ?>
					<ul class="list">
						<?php while ($the_query->have_posts()): $the_query->the_post() ?>
							<li>
								<?php
									$_block = [];
									$_blocks = get_field('blocks');
									if ($_blocks) {
										$_blocks = array_map(function($block) {
											if ($block['acf_fc_layout'] == 'photo_text') {
												return $block;
											}
										}, $_blocks);
										$_blocks = array_filter($_blocks);
										$_block = call_user_func_array('array_merge', $_blocks);
									}
								?>
								<a href="<?php the_permalink() ?>">
									<figure class="image">
										<?php if (has_post_thumbnail()) the_post_thumbnail() ?>
									</figure>
								</a>

								<article class="text">
									<h3><?php the_title() ?></h3>
									<p><?php echo wp_trim_words($_block['intro_text'], 28) ?></p>
									<p class="more-link">
										<a href="<?php the_permalink() ?>">Learn More</a>
									</p>
								</article>
							</li>
						<?php endwhile; wp_reset_postdata() ?>
					</ul>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>
