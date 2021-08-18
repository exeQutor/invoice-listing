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
					</ul>
				</div>

				<div class="invoice-search">
					<form action="<?php echo home_url() ?>" method="get">
				    <input type="text" name="s" value="<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>" placeholder="Search" />
				    <input type="hidden" name="post_type" value="invoice" />
				    <input type="submit" value="Search" />
					</form>
				</div>

				<?php if (have_posts()): ?>
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
						<?php while (have_posts()): the_post() ?>
							<tr>
								<td>#<?php the_ID() ?></td>
								<td><?php the_title() ?></td>
								<td><?php the_field('status') ?></td>
								<td><?php the_field('start_date') ?></td>
								<td><?php the_field('end_date') ?></td>
								<td>HK$<?php the_field('total') ?></td>
								<td>HK$<?php the_field('fees') ?></td>
								<td>HK$<?php the_field('transfer') ?></td>
								<td><?php the_field('orders') ?></td>
							</tr>
						<?php endwhile; ?>
					</table>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>
