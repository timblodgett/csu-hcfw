<?php
/**
 * Template part for displaying page content in reunions.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSU_Homecoming_&_Family_Weekend
 */

$args = array(
	'posts_per_page' =>  999,
	'post_type'      => 'hcfw_event',
	'meta_query'     =>  array(
		'relation' => 'AND',
		'reunions' =>  array(
			'key'     => '_hcfw_event_reunion',
			'value'   =>  1
		),
		'date'     =>  array(
			'key'     => '_hcfw_event_date',
			'value'   =>  array(
				date('Y-01-01'),
				date('Y-12-31')
			),
			'type'    => 'date',
			'compare' => 'BETWEEN'
		),
		'time'     =>  array(
			'key'     => '_hcfw_event_start_time',
			'compare' => 'EXISTS'
		)
	),
	'orderby'        =>  array(
		'date'  => 'ASC',
		'time'  => 'ASC',
		'title' => 'ASC'
	)
);

$terms = get_terms( array(
	'taxonomy' => 'hcfw_event_organization',
	'orderby'  => 'name',
	'order'    => 'ASC'
) );

$reunions = new WP_query( $args );
if ( $reunions->have_posts() ) {
	$have_reunions = true;
	wp_reset_postdata();
} else {
	$have_reunions = false;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php csu_hcfw_post_thumbnail(); ?>

	<div class="entry-content">
		<div class="wrapper">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php the_content(); ?>

			<?php if ( $have_reunions && !empty( $terms ) ) : ?>

				<div class="hcfw-reunions">
					<?php
					foreach( $terms as $term ) :
						$args['tax_query'] = array( array(
							'taxonomy' => 'hcfw_event_organization',
							'field'    => 'slug',
							'terms'    => $term->slug
						) );
						$org = new WP_query( $args );

						if ( $org->have_posts() ) {
					?>
						<div class="organization">
							<h2 class="organization-name"><?php echo $term->name; ?></h2>

							<?php
							while( $org->have_posts() ) : $org->the_post();
								$locations = get_the_terms( $post->ID, 'hcfw_event_location' );
								$all_day = get_post_meta( $post->ID, '_hcfw_event_all_day', true );
								$date = get_post_meta( $post->ID, '_hcfw_event_date', true );
								$start_time = get_post_meta( $post->ID, '_hcfw_event_start_time', true );
								$end_time = get_post_meta( $post->ID, '_hcfw_event_end_time', true );
								$room = get_post_meta( $post->ID, '_hcfw_event_room', true );
								$register = get_post_meta( $post->ID, '_hcfw_event_register', true );
							?>
							<div class="reunion">
								<div class="reunion-desc">
									<h3 class="reunion-name"><?php the_title(); ?></h3>

									<?php the_content(); ?>
								</div><!-- .reunion-desc -->

								<div class="reunion-details">
									<div class="detail date">
										<span class="icon fas fa-calendar" title="Date" aria-hidden></span>
										<span class="screen-reader-text">Date</span>
										<p><?php echo date( 'l, F j', strtotime( $date ) ); ?></p>
									</div><!-- .date -->
									<div class="detail time">
										<span class="icon fas fa-clock" title="Time" aria-hidden></span>
										<span class="screen-reader-text">Time</span>
										<p>
											<?php echo ( $all_day ) ? __( 'All Day', 'csu-hcfw' ) : get_csu_time_format( $start_time, $end_time ); ?>
										</p>
									</div><!-- .time -->

									<?php if ( $locations ) : ?>
									<div class="detail location">
										<span class="icon fas fa-map-marker-alt" title="Location" aria-hidden></span>
										<span class="screen-reader-text">Location</span>
										<p>
											<?php echo ( $address = get_term_meta( $locations[0]->term_id, '_location_address', true ) ) ? '<a href="//www.google.com/maps/place/'.urlencode( $address ).'" target="_blank" rel="noopener">'.$locations[0]->name.'</a>' : $locations[0]->name; ?>
											<?php echo ( $room ) ? ' <span class="room">'.$room.'</span>' : ''; ?>
										</p>
									</div><!-- .location -->
									<?php endif; ?>

									<?php if ( $register ) : ?>
										<div class="register-link">
											<a class="button" href="<?php echo esc_url( $register ); ?>" target="_blank" rel="noopener">Register <span class="screen-reader-text"><?php echo __( 'for ', 'csu-hcfw' ); the_title(); ?></span></a>
										</div><!-- .register-link -->
									<?php endif; ?>
								</div><!-- .reunion-details -->
							</div><!-- .reunion -->
							<?php endwhile; ?>
						</div><!-- .organization -->
					<?php
							wp_reset_postdata();
						}
						endforeach;
					?>
				</div><!-- .hcfw-reunions -->

			<?php else : ?>

				<p><?php _e( 'There are no reunions scheduled at this time.', 'csu-hcfw' ); ?></p>

			<?php endif; ?>
		</div><!-- .wrapper -->
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
