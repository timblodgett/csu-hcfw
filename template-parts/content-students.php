<?php
/**
 * Template part for displaying page content in students.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSU_Homecoming_&_Family_Weekend
 */

$args = array(
	'posts_per_page' =>  999,
	'post_type'      => 'hcfw_event',
	'tax_query'      =>  array( array(
		'taxonomy' => 'hcfw_event_audience',
		'field'    => 'slug',
		'terms'    => 'student'
	) ),
	'meta_query'     =>  array(
		'relation'   => 'AND',
		'date'       =>  array(
			'key'     => '_hcfw_event_date',
			'value'   => array(
				date('Y-01-01'),
				date('Y-12-31')
			),
			'type'    => 'date',
			'compare' => 'BETWEEN'
		),
		'start_time' =>  array(
			'key'     => '_hcfw_event_start_time',
			'compare' => 'EXISTS'
		),
		'end_time'   =>  array(
			'key'     => '_hcfw_event_end_time',
			'compare' => 'EXISTS'
		)
	),
	'orderby'        =>  array(
		'date'        => 'ASC',
		'start_time'  => 'ASC',
		'end_time'    => 'ASC',
		'title'       => 'ASC'
	)
);

$all_events = new WP_query( $args );
if ( $all_events->have_posts() ) {
	$event_dates = array();

	while( $all_events->have_posts() ) {
		$all_events->the_post();
		$date = get_post_meta( $post->ID, '_hcfw_event_date', true );

		if ( !in_array( $date, $event_dates ) ) {
			$event_dates[] = $date;
		}
	}
	wp_reset_postdata();
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

			<?php if ( $event_dates ) : ?>

				<div class="hcfw-student-events">
					<?php
					foreach( $event_dates as $the_date ) :
						$args['meta_query']['date'] = array(
							'key'     => '_hcfw_event_date',
							'value'   => $the_date,
							'type'    => 'date'
						);
						$daily_events = new WP_query( $args );

						if ( $daily_events->have_posts() ) {
					?>
						<div class="event-date">
							<h2 class="date-name"><span class="name-inner"><span class="date-day"><?php echo date( 'l', strtotime( $the_date ) ); ?></span><span class="date-sep">, </span><span class="date-month-num"><?php echo date( 'F j', strtotime( $the_date ) ); ?></span></span></h2>

							<?php
							while( $daily_events->have_posts() ) : $daily_events->the_post();
								$locations = get_the_terms( $post->ID, 'hcfw_event_location' );
								$all_day = get_post_meta( $post->ID, '_hcfw_event_all_day', true );
								$date = get_post_meta( $post->ID, '_hcfw_event_date', true );
								$start_time = get_post_meta( $post->ID, '_hcfw_event_start_time', true );
								$end_time = get_post_meta( $post->ID, '_hcfw_event_end_time', true );
								$room = get_post_meta( $post->ID, '_hcfw_event_room', true );
								$register = get_post_meta( $post->ID, '_hcfw_event_register', true );
							?>
							<div class="event">
								<div class="event-desc">
									<h3 class="event-name"><?php the_title(); ?></h3>

									<?php the_content(); ?>
								</div><!-- .event-desc -->

								<div class="event-details">
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
								</div><!-- .event-details -->
							</div><!-- .event -->
							<?php endwhile; ?>
						</div><!-- .organization -->
					<?php
							wp_reset_postdata();
						}
						endforeach;
					?>
				</div><!-- .hcfw-student-events -->

			<?php else : ?>

				<p><?php _e( 'There are no events scheduled at this time.', 'csu-hcfw' ); ?></p>

			<?php endif; ?>
		</div><!-- .wrapper -->
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
