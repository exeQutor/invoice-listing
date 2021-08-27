<?php $company = get_field('company', 'options') ?>

<section class="<?php echo $section_class ?>">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<div class="grid-x blue-row">
					<div class="cell large-5">
						<div class="map">
							<?php echo $company['map_embed'] ?>
						</div>
					</div>

					<div class="cell large-7">
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
						<div class="company-info">
							<div class="grid-x">
								<div class="cell large-6">
									<address class="address">
										<h4>Address</h4>
										<p><?php echo $company['office_address'] ?></p>
									</address>
								</div>

								<div class="cell large-6">
									<address class="address">
										<h4>Reach Us</h4>
										<p>Phone: <strong><?php echo $company['phone_number'] ?></strong><br>
										Fax: <strong><?php echo $company['fax_number'] ?></strong><br>
										Email: <?php echo acf_link($company['email_address']) ?></p>
									</address>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
