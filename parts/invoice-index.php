<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'post_type'=>'invoice',
	'posts_per_page' => 3,
	'paged' => $paged,
	's' => get_search_query()
);

if (isset($_GET['start']) && isset($_GET['end'])) {
	$today = date('Ymd');
	$start_date = $_GET['start'];
	$end_date = $_GET['end'];

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

// var_dump($start_date);
// var_dump($end_date);

$cpt_invoice = new WP_Query($args);

?>

<section class="invoice-section">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell">
				<div class="invoice-filter">
					<ul>
						<li>
							<a href="<?php echo home_url('/invoices/') ?>">All</a>
						</li>
						<li>
							<a href="<?php $wp->query_vars['status'] = 'ongoing'; echo add_query_arg( $wp->query_vars, home_url() ) ?>">Ongoing</a>
						</li>
						<li>
							<a href="<?php $wp->query_vars['status'] = 'verified'; echo add_query_arg( $wp->query_vars, home_url() ) ?>">Verified</a>
						</li>
						<li>
							<a href="<?php $wp->query_vars['status'] = 'pending'; echo add_query_arg( $wp->query_vars, home_url() ) ?>">Pending</a>
						</li>
						<li>
							<a href="<?php $wp->query_vars['start'] = '1'; echo add_query_arg( $wp->query_vars, home_url() ) ?>">Date range test</a>
						</li>
					</ul>
				</div>

				<div class="invoice-date-picker">
					<input type="text" name="invoicedates" value="08/01/2021 - 08/15/2021">
				</div>

				<div class="invoice-search">
					<form action="<?php echo home_url() ?>" method="GET">
				    <input type="text" name="s" value="<?php echo get_search_query() ?>" placeholder="Search" />
				    <input type="hidden" name="post_type" value="invoice" />
				    <input type="submit" value="Search" />
					</form>
				</div>

				<?php if ($cpt_invoice->have_posts()): ?>
					<table>
						<tr>
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
							<tr>
								<td>#<?php the_ID() ?></td>
								<td><?php the_title() ?></td>
								<td><?php the_field('status') ?></td>
								<td><?php echo date('l d F, Y', strtotime(get_field('start_date'))) ?></td>
								<td><?php echo date('l d F, Y', strtotime(get_field('end_date'))) ?></td>
								<td>HK$<?php the_field('total') ?></td>
								<td>HK$<?php the_field('fees') ?></td>
								<td>HK$<?php the_field('transfer') ?></td>
								<td><?php the_field('orders') ?></td>
							</tr>
						<?php endwhile; ?>
					</table>

					<?php

					$total_pages = $cpt_invoice->max_num_pages;

					if ($total_pages > 1){
						$current_page = max(1, get_query_var('paged'));

						echo paginate_links(array(
							// 'base' => get_pagenum_link(1) . '%_%',
							// 'format' => '/page/%#%',
							'current' => $current_page,
							'total' => $total_pages,
							'prev_text'    => __('« prev'),
							'next_text'    => __('next »'),
						));
					}

					?>

				<?php else: ?>

					<p>No invoices found.</p>

				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>
