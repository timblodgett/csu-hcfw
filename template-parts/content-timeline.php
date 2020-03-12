<?php
/**
 * Template part for displaying page content in timeline.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSU_Homecoming_&_Family_Weekend
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php csu_hcfw_post_thumbnail(); ?>

	<div class="entry-content">
		<div class="wrapper">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php
			// get a list of "event_year" taxonomy terms
			$terms = get_terms( 'event_year' );

			// if there are "event_year" taxonomy terms create the timeline
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				echo '<ul class="timeline">';

				foreach ( $terms as $term ) {
					$tax_args = array(
						'taxonomy' => 'event_year',
						'field'    => 'name',
						'terms'    =>  $term->name,
					);

					$query_args = array(
						'post_type' => 'timeline',
						'orderby'   => 'title',
						'order'     => 'ASC',
						'tax_query' =>  array( $tax_args ),
					);

					$timeline = new WP_query( $query_args );

					if ( $timeline->have_posts() ) :
						while ( $timeline->have_posts() ) :
							$timeline->the_post();
			?>

					<li class="event">
						<div class="point">
							<p><?php echo $term->name ?></p>
						</div>

						<div class="info">
							<div class="container">
								<header>
									<h3 class="heading"><?php the_title(); ?></h3>
								</header>

								<?php the_content(); ?>
							</div>
						</div>
					</li>

			<?php
							$i++;
						endwhile;
					endif;

					wp_reset_postdata(); // reset the loop

				} // end foreach loop

				echo '<li class="event"><div class="point">';
				echo '<div class="wrapper"><p>' . date("Y") . '</p></div>';
				echo '</div></div></li>';
				echo '</ul> <!-- .timeline -->';

			}
			?>
		</div><!-- .wrapper -->
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
