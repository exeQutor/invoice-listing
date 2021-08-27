<section class="blog blog--index">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<?php if (have_posts()): ?>
					<?php while (have_posts()): the_post() ?>
						<article class="article">
							<h2 class="page-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

							<div class="page-content">
								<?php the_excerpt() ?>
							</div>
						</article>
					<?php endwhile; ?>
				<?php endif ?>

				<?php wp_pagenavi() ?>
			</div>
		</div>
	</div>
</section>
