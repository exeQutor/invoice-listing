<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'post_type'=>'invoice',
	'posts_per_page' => 12,
	'paged' => $paged,
	's' => get_search_query()
);

// assign and sanitize url parameters
$start_date = isset($_GET['start']) ? sanitize_text_field($_GET['start']) : '';
$end_date = isset($_GET['end']) ? sanitize_text_field($_GET['end']) : '';
$status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';

// if set, add start date and end date to meta query
if ($start_date && $end_date) {
	$today = date('Ymd');
	$start_date = sanitize_text_field($_GET['start']);
	$end_date = sanitize_text_field($_GET['end']);

	$args['meta_query'] = array(
		array(
			'key' => 'start_date',
			'compare' => '>=',
			'value' => $start_date
		),
		array(
			'key' => 'end_date',
			'compare' => '<=',
			'value' => $end_date
		)
	);
}

$cpt_invoice = new WP_Query($args);

// if set, add start date and end date to query vars
if ($start_date) $wp->query_vars['start'] = $start_date;
if ($end_date) $wp->query_vars['end'] = $end_date;

// start with an empty date picker but add a placeholder
$date_picker_start = $start_date ? DateTime::createFromFormat('Ymd', $start_date)->format('m/d/Y') : date('m/d/Y');
$date_picker_end = $end_date ? DateTime::createFromFormat('Ymd', $end_date)->format('m/d/Y') : date('m/d/Y', strtotime('+5 days'));
$date_picker_value = $start_date && $end_date ? $date_picker_start . ' - ' . $date_picker_end : '';

?>

<section class="invoice-section">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<h1>Invoices</h1>

				<div class="invoice-actions">
					<div class="invoice-filter">
						<ul>
							<li <?php echo $status ? '' : ' class="active"' ?>>
								<a href="<?php echo home_url('/invoices/') ?>">All</a>
							</li>
							<li <?php echo $status == 'ongoing' ? ' class="active"' : '' ?>>
								<a href="<?php $wp->query_vars['status'] = 'ongoing'; echo add_query_arg( $wp->query_vars, home_url() ) ?>">Ongoing</a>
							</li>
							<li <?php echo $status == 'verified' ? ' class="active"' : '' ?>>
								<a href="<?php $wp->query_vars['status'] = 'verified'; echo add_query_arg( $wp->query_vars, home_url() ) ?>">Verified</a>
							</li>
							<li <?php echo $status == 'pending' ? ' class="active"' : '' ?>>
								<a href="<?php $wp->query_vars['status'] = 'pending'; echo add_query_arg( $wp->query_vars, home_url() ) ?>">Pending</a>
							</li>
						</ul>
					</div>

					<div class="invoice-date-picker">
						<label for="invoicedates"><img src="<?php echo bm_images_url('calendar.svg') ?>" alt=""> From</label>
						<input type="text" name="invoicedates" id="invoicedates" value="<?php echo $date_picker_value ?>" placeholder="<?php echo $date_picker_start . ' - ' . $date_picker_end ?>">
					</div>

					<div class="invoice-search">
						<form action="<?php echo home_url() ?>" method="GET">
					    <input type="text" name="s" value="<?php echo get_search_query() ?>" placeholder="Search" />
					    <input type="hidden" name="post_type" value="invoice" />

							<?php if ($start_date): ?>
								<input type="hidden" name="start" value="<?php echo $start_date ?>" />
							<?php endif ?>

							<?php if ($end_date): ?>
								<input type="hidden" name="end" value="<?php echo $end_date ?>" />
							<?php endif ?>

					    <input class="search-button" type="hidden" value="Search" />
						</form>
					</div>

					<div class="invoice-mark">
						<button class="button" type="button" id="invoice-mark-paid">Mark as paid</button>
					</div>
				</div>

				<?php if ($cpt_invoice->have_posts()): ?>
					<table class="invoice-list table">
						<tr>
							<th><input type="checkbox" id="select-all-invoices"></th>
							<th>ID</th>
							<th>Restaurant</th>
							<th>Status</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Total</th>
							<th>Fees</th>
							<th>Transfer</th>
							<th>Orders</th>
						</tr>
						<?php while ($cpt_invoice->have_posts()): $cpt_invoice->the_post() ?>
							<?php $status = get_field('status') ?>
							<tr>
								<td><input class="invoices-checkbox" type="checkbox" name="invoice-<?php echo the_ID() ?>" data-invoice-id="<?php the_ID() ?>"></td>
								<td>#<?php the_ID() ?></td>
								<td class="restaurant">
									<?php if (has_post_thumbnail()):
										the_post_thumbnail('thumbnail');
										else: ?>
										<img class="wp-post-image" src="https://picsum.photos/200?random=<?php echo the_ID() ?>" alt="">
									<?php endif ?>
									<?php the_title() ?>
								</td>
								<td class="text-center"><span class="status status--<?php the_ID() ?> status--<?php echo $status['value'] ?>"><?php echo $status['label'] ?></span></td>
								<td class="text-center"><?php echo date('d/m/Y', strtotime(get_field('start_date'))) ?></td>
								<td class="text-center"><?php echo date('d/m/Y', strtotime(get_field('end_date'))) ?></td>
								<td class="text-center">HK$<?php the_field('total') ?></td>
								<td class="text-center">HK$<?php the_field('fees') ?></td>
								<td class="text-center">HK$<?php the_field('transfer') ?></td>
								<td class="text-center"><?php the_field('orders') ?></td>
							</tr>
						<?php endwhile; ?>
					</table>

					<div class="invoice-footer">
						<?php
							$total_pages = $cpt_invoice->max_num_pages;

							if ($total_pages > 1){
								$current_page = max(1, get_query_var('paged'));
							}
						?>

						<div class="invoice-pagenum">
							<p>Page <?php echo $current_page ?> of <?php echo $total_pages ?></p>
						</div>

						<div class="invoice-pagenav">
							<?php
								if ($total_pages > 1){
									echo paginate_links(array(
										'current' => $current_page,
										'total' => $total_pages,
										'prev_text'    => '<',
										'next_text'    => '>',
									));
								}
							?>
						</div>
					</div>

				<?php else: ?>

					<div class="callout warning">
					  <h5>No invoices found</h5>
					  <p>Please review your search term, status filter, or date range options.</p>
					</div>

				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>
