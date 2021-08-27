<?php
/**
* Template Name: Builder Page
*/

get_header();
the_post();

global $post;
$post_slug = $post->post_name;
?>

<main class="main">
	<?php
		if (have_rows('blocks')) {
			while (have_rows('blocks')) {
				the_row();

				$row_layout = get_row_layout();

				$classes = [
					$row_layout,
					$row_layout . '--' . $post_slug
				];

				if ( ! is_front_page()) {
					$classes[] = $row_layout . '--inner';
				}

				$section_class = implode(' ', $classes);

				if (file_exists(get_template_directory() . "/blocks/{$row_layout}.php")) {
					include(locate_template("blocks/{$row_layout}.php"));
				} else {
					include(locate_template("blocks/not-ready.php"));
				}
			}
		}
	?>
</main>

<?php get_footer() ?>
