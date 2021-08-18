<?php
$subheading = get_sub_field('subheading');
$heading = get_sub_field('heading');
$button = get_sub_field('button');
?>

<section class="<?php echo $section_class ?>" style="background-image: url(<?php echo get_sub_field('background_image')['url'] ?>)" data-stellar-background-ratio="0.5">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<div class="overlay"></div>
				<div class="content">
					<?php if ($subheading): ?><h4><?php echo $subheading ?></h4><?php endif ?>
					<?php if ($heading): ?><h1><?php echo $heading ?></h1><?php endif ?>
					<?php if ($button): ?><p class="custom-button"><?php acf_link($button) ?></p><?php endif ?>
				</div>
			</div>
		</div>
	</div>
</section>
