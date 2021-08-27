<header class="header">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell large-6">
				<div class="header-logo-nav">
					<div class="header-logo">
						<a href="<?php bloginfo('url') ?>"><img src="<?php echo bm_images_url('logo.jpg') ?>" alt=""></a>

						<a class="show-for-small-only" id="mobile-menu" href="#"><img src="<?php echo bm_images_url('list.png') ?>" alt=""></a>
					</div>

					<?php wp_nav_menu(array(
						'menu' => 'header-nav',
						'menu_class' => 'header-nav-list header-nav-list--sp',
						'container' => 'nav',
						'container_class' => 'header-nav'
					)) ?>
				</div>
			</div>

			<div class="cell large-6 show-for-large">
				<div class="header-user">
					<p>Wallace Huo</p>
				</div>
			</div>
		</div>
	</div>
</header>
