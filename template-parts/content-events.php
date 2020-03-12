<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSU_Homecoming_&_Family_Weekend
 */

$event_dates = array();
$current_year = '';

$args = array(
	'posts_per_page' =>  999,
	'post_type'      => 'hcfw_event',
	'meta_query'     =>  array(
		'relation'   => 'AND',
		'date'       =>  array(
			'key'     => '_hcfw_event_date',
			'value'   =>  array(
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
		'date'       => 'ASC',
		'start_time' => 'ASC',
		'end_time'   => 'ASC',
		'title'      => 'ASC'
	)
);

$all_events = new WP_Query( $args );

if ( $all_events->have_posts() ) {
	while ( $all_events->have_posts() ) {
		$all_events->the_post();
		$event_date = get_post_meta( $post->ID, '_hcfw_event_date', true );
		if ( !in_array( $event_date, $event_dates ) ) {
			$event_dates[] = $event_date;
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

			<?php if ( !empty($event_dates) ) : ?>
			<div class="hcfw-events-calendar tabbed">
				<ul class="dates-list">
					<?php foreach( $event_dates as $the_date ) : ?>
					<li class="date">
						<a href="#events-for-<?php echo $the_date; ?>">
							<span class="date-name"><?php echo date( 'D', strtotime( $the_date ) ); ?></span>
							<span class="screen-reader-text">, <?php echo date( 'M', strtotime( $the_date ) ); ?></span>
							<span class="date-num"><?php echo date( 'j', strtotime( $the_date ) ); ?></span>
							<span class="screen-reader-text">, <?php echo date( 'Y', strtotime( $the_date ) ); ?></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul><!-- .dates-list -->

				<div class="events-panels">
					<?php
					foreach( $event_dates as $the_date ) {
						$date_args = $args;
						$date_args['meta_query']['date'] = array(
							'key'   => '_hcfw_event_date',
							'value' => $the_date
						);
						$date_events = new WP_Query( $date_args );

						if ( $date_events->have_posts() ) {
					?>
					<ul id="events-for-<?php echo $the_date; ?>" class="events-list panel">
						<?php
						while ( $date_events->have_posts() ) : $date_events->the_post();
							$desc = get_post_meta( $post->ID, '_hcfw_event_desc', true );
							$locations = get_the_terms( $post->ID, 'hcfw_event_location' );
							$room = get_post_meta( $post->ID, '_hcfw_event_room', true );
							$organizations = get_the_terms( $post->ID, 'hcfw_event_organization' );
							$audiences = get_the_terms( $post->ID, 'hcfw_event_audience' );
							$event_date = get_post_meta( $post->ID, '_hcfw_event_date', true );
							$all_day = get_post_meta( $post->ID, '_hcfw_event_all_day', true );
							$start_time = get_post_meta( $post->ID, '_hcfw_event_start_time', true );
							$end_time = get_post_meta( $post->ID, '_hcfw_event_end_time', true );
							$website = get_post_meta( $post->ID, '_hcfw_event_website', true );
							$tickets = get_post_meta( $post->ID, '_hcfw_event_tickets', true );
							$register = get_post_meta( $post->ID, '_hcfw_event_register', true );
						?>
						<li class="hcfw-event">
							<header class="event-header">
								<h2 class="event-name"><?php the_title(); ?></h2>

								<?php if ( $subtitle = get_post_meta( $post->ID, '_hcfw_event_subtitle', true ) ) : ?>
								<p class="event-subtitle"><?php echo esc_attr($subtitle); ?></p>
								<?php endif; ?>
							</header>

							<div class="event-time">
								<div class="container">
									<span class="icon far fa-clock" title="Time" aria-hidden></span>
									<span class="screen-reader-text">Time:</span>
									<p>
										<?php echo ( $all_day ) ? __( 'All Day', 'csu-hcfw' ) : get_hcfw_time_format( $start_time, $end_time ); ?>
									</p>
								</div><!-- .container -->
							</div><!-- .event-time -->

							<div class="event-details">
								<?php if ( $locations ) : ?>
								<div class="location">
									<div class="container">
										<span class="icon fas fa-map-marker-alt" title="Location" aria-hidden></span>
										<span class="screen-reader-text">Location:</span>
										<p>
											<?php echo ( $address = get_term_meta( $locations[0]->term_id, '_location_address', true ) ) ? '<a href="//www.google.com/maps/place/'.urlencode( $address ).'">'.$locations[0]->name.'</a>' : $locations[0]->name; ?>
											<?php echo ( $room ) ? ' <span class="room">'.$room.'</span>' : '';
											?>
										</p>
									</div><!-- .container -->
								</div><!-- .location -->
								<?php endif; ?>

								<div class="event-desc">
									<!-- <span class="icon fas fa-comment-alt" aria-hidden></span> -->
									<div class="container">
										<?php the_content(); ?>
									</div><!-- .container -->
								</div><!-- .event-desc -->

								<?php if ( $website || $tickets || $register ) : ?>
								<div class="event-links">
									<?php if ( $website ) : ?>
									<a class="website link" href="<?php echo esc_url( $website ); ?>"><span class="icon fas fa-link" aria-hidden></span><span class="screen-reader-text"><?php _e('Visit', 'csu-hcfw' ); ?> <?php the_title(); ?> </span><span class="link-text"><?php _e( 'Website', 'csu-hcfw' ); ?></span></a>
									<?php endif; ?>

									<?php if ( $tickets ) : ?>
									<a class="ticket link" href="<?php echo esc_url( $tickets ); ?>"><span class="icon fas fa-ticket-alt" aria-hidden></span><span class="screen-reader-text"><?php _e('Buy', 'csu-hcfw' ); ?> <?php the_title(); ?> </span><span class="link-text"><?php _e( 'Tickets', 'csu-hcfw' ); ?></span></a>
									<?php endif; ?>

									<?php if ( $register ) : ?>
									<a class="register link" href="<?php echo esc_url( $register ); ?>"><span class="icon fas fa-edit" aria-hidden></span><span class="link-text"><?php _e( 'Register', 'csu-hcfw' ); ?></span><span class="screen-reader-text"><?php _e('for', 'csu-hcfw' ); ?> <?php the_title(); ?> </span></a>
									<?php endif; ?>
								</div>
								<?php endif; ?>
							</div><!-- .event-details -->
						</li><!-- .hcfw-event -->
						<?php endwhile; wp_reset_postdata(); ?>
					</ul><!-- .events-list -->
					<?php
						}
					}
					?>
				</div><!-- .events-panels -->
			</div><!-- .hcfw-events-calendar -->
			<?php
			else :
				if ( class_exists('acf') && get_field('no_events_msg', 'option') ) :
			?>
				<p class="no-events"><?php the_field('no_events_msg', 'option'); ?></p>
			<?php
				endif;
			endif;
			?>
		</div><!-- .wrapper -->
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
