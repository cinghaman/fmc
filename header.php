<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _tk
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>

<header id="masthead" class="site-header" role="banner">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<?php if ( get_theme_mod( 'custom_logo' ) ) : ?>
						<div class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img src="<?php echo esc_url( get_theme_mod( 'custom_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							</a>
						</div>
                <?php else : ?>
                        <hgroup class="identity">
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </hgroup>
                <?php endif; ?>
			</div> <!-- logo -->
			<div class="col-md-8 col-sm-8 col-xs-12">
				<nav class="site-navigation">
					<?php // substitute the class "container-fluid" below if you want a wider content area ?>
					<div class="navbar navbar-default">
						<div class="navbar-header">
							<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
								<span class="sr-only"><?php _e('Toggle navigation','_tk') ?> </span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
		
							<!-- Your site title as branding in the menu -->
						</div>

						<!-- The WordPress Menu goes here -->
						<?php wp_nav_menu(
							array(
								'theme_location' 	=> 'primary',
								'depth'             => 2,
								'container'         => 'div',
								'container_id'      => 'navbar-collapse',
								'container_class'   => 'collapse navbar-collapse',
								'menu_class' 		=> 'nav navbar-nav',
								'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
								'menu_id'			=> 'main-menu',
								'walker' 			=> new wp_bootstrap_navwalker()
							)
						); ?>

					</div><!-- .navbar -->
				</nav><!-- .site-navigation -->
			</div> <!-- primary navigation ends -->
		</div> <!-- row -->
	</div> <!-- container -->
</header>
<div class="main-content">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
<?php if (is_home() || is_front_page() || is_singular( 'job_listing' )) { ?>
	<div class="container-fluid">
		<div class="row">
				<div id="content" class="main-content-inner col-sm-12 col-md-12">
			<?php } else { ?>
			<div class="container">
				<div class="row">
					<div id="content" class="main-content-inner col-sm-12 col-md-8">
			<?php } ?>