<header id="sticky-header" class="header">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell large-3">
				<div class="header-logo">
					<a href="<?php bloginfo('url') ?>"><img src="<?php echo bm_images_url('logo.svg') ?>" alt=""></a>
				</div>
			</div>

			<div class="cell large-3">

			</div>

			<div class="cell large-6">
				<?php wp_nav_menu(array(
					'menu' => 'header-nav',
					'menu_class' => 'header-nav-list',
					'container' => 'nav',
					'container_class' => 'header-nav'
				)) ?>
			</div>
		</div>
	</div>
</header>
