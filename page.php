<?php
get_header();
the_post();
?>

<main class="main">
	<?php get_template_part('parts/page', 'default') ?>
</main>

<?php get_footer() ?>
