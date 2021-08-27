<section class="<?php echo $section_class ?>">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<header class="heading">
					<h4><?php the_sub_field('subheading') ?></h4>
					<h2><?php the_sub_field('heading') ?></h2>
				</header>

				<div class="grid-x">
					<div class="cell large-5 medium-6 small-12">
						<?php $attorney = get_sub_field('attorney') ?>
						<figure class="custom-card">
							<img src="<?php echo $attorney['photo']['url'] ?>" alt="<?php echo $attorney['photo']['alt'] ?>">
							<figcaption>
								<h3><?php echo $attorney['name'] ?></h3>
								<p><?php echo $attorney['title'] ?></p>
								<p class="custom-button"><?php echo acf_link($attorney['button']) ?></p>
							</figcaption>
						</figure>
					</div>

					<div class="cell large-7 medium-6 small-12">
						<article class="text">
							<?php the_sub_field('text') ?>
							<p class="more-link"><?php echo acf_link(get_sub_field('more_link')) ?></p>
						</article>
					</div>
				</div>

				<div class="grid-x blue-row">
					<div class="cell large-offset-5 large-7">
						<aside class="practice">
							<ul>
								<?php foreach (get_sub_field('practice_list') as $post): setup_postdata($post) ?>
									<li>
										<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
									</li>
								<?php endforeach; wp_reset_postdata() ?>
							</ul>
							<p class="view-all"><?php echo acf_link(get_sub_field('view_all')) ?></p>
						</aside>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
