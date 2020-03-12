<?php
/**
 * Template part for displaying page content in page.php
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
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'csu-hcfw' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .wrapper -->
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
