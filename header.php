<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CSU_Homecoming_&_Family_Weekend
 */

$identifier = __( 'Homecoming &amp; Family Weekend', 'csu-hcfw' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-57x57.png'; ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-60x60.png'; ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-72x72.png'; ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-76x76.png'; ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-114x114.png'; ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-120x120.png'; ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-144x144.png'; ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-152x152.png'; ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri().'/images/favicon/apple-icon-180x180.png'; ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri().'/images/favicon/android-icon-192x192.png'; ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri().'/images/favicon/favicon-32x32.png'; ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri().'/images/favicon/favicon-96x96.png'; ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri().'/images/favicon/favicon-16x16.png'; ?>">
	<link rel="manifest" href="<?php echo get_template_directory_uri().'/images/favicon/manifest.json'; ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri().'/images/favicon/ms-icon-144x144.png'; ?>">
	<meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-901712-24', 'auto');
		ga('send', 'pageview');
	</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a href="#content" class="skip-link screen-reader-text"><?php esc_html_e( 'Skip to content', 'csu-hcfw' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-top">
			<div class="wrapper">
				<div class="site-branding">
					<div class="csu-signature">
						<a href="//www.colostate.edu/" class="signature-link" target="_blank" rel="noopener">
							<span class="screen-reader-text"><?php _e( 'Colorado State University', 'csu-hcfw' ); ?></span>
						</a>
					</div><!-- .csu-signature -->

					<?php if ( is_front_page() ) : ?>
						<h1 class="secondary-identifier">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="identifier-link" rel="home"><?php echo $identifier; ?></a>
						</h1><!-- .secondary-identifier -->
					<?php else : ?>
						<div class="secondary-identifier">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="identifier-link" rel="home"><?php echo $identifier; ?></a>
						</div><!-- .secondary-identifier -->
					<?php endif; ?>
				</div><!-- .site-branding -->

				<?php if ( class_exists('acf') && get_field('header_dates', 'option') ) : ?>
				<div class="site-dates">
					<p><?php the_field('header_dates', 'option'); ?></p>
				</div><!-- .site-dates -->
				<?php endif; ?>
			</div><!-- .wrapper -->
		</div><!-- .header-top -->

		<nav id="site-navigation" class="header-nav main-navigation">
			<div class="wrapper">
				<button id="primary-menu-toggle" class="menu-toggle" aria-controls="primary-menu">
					<span class="fas fa-bars"></span>
					<?php esc_html_e( 'Menu', 'csu-hcfw' ); ?>
				</button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'depth'          =>  2
				) );
				?>
			</div><!-- .wrapper -->
		</nav><!-- .main-navigation -->
		<!-- .header-nav -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
