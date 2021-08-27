<?php $photo = get_sub_field('photo') ?>

<section class="<?php echo $section_class ?>">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<div class="grid-x blue-row">
					<div class="cell large-5 medium-6 small-12">
						<figure class="photo">
							<img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['alt'] ?>">
						</figure>
					</div>

					<div class="cell large-7 medium-6 small-12">
						<header class="heading">
							<h4><?php the_sub_field('subheading') ?></h4>
							<h2><?php the_sub_field('heading') ?></h2>
						</header>

						<article class="intro-text">
							<p><?php the_sub_field('intro_text') ?></p>
						</article>
					</div>
				</div>

				<div class="grid-x">
					<div class="cell large-offset-5 large-7">
						<article class="main-text">
							<?php the_sub_field('main_text') ?>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
