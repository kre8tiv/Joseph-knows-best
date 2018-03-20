<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>


		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- mobile  -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="default" />
		

		<!-- icons & favicons -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/lib/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/lib/images/win8-tile-icon.png">


		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>
		
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/lib/js/responsive.js"></script>
		<![endif]-->
		
		<?php if (get_header_image() != '') {	?><style>#header.widthimg {margin: 0;background: url(<?php header_image(); ?>) top center no-repeat;background-size: cover;}</style><?php } ?>

		
	</head>

	<body <?php body_class(); ?>>
	
		<nav class="unsichtbar"><h6>Sprungmarken dieser Website</h6><ul>
			<li><a href="#content">Direkt zum Inhalt</a></li>
			<li><a href="#hauptmenue">Zur Navigation</a></li>
			<li><a href="#sidebar1">Seitenleiste mit weiterführenden Informationen</a></li>
			<li><a href="#footer">Zum Fußbereich</a></li>
		</ul></nav>
		
		

			
		<!-- header -->
		<header id="header">
			
			<div class="sitetitle">
				<h2><?php bloginfo('name'); ?></h2>
				<h2><?php bloginfo('description'); ?></h2>
			</div>
				
			<!-- fixed mobile header -->
			<section class="header-mobile">
				<h2><?php bloginfo('name'); ?></h2>
				<a class="switch-menu" href="#nav-mobile"><span class="fa fa-bars"></span><span class="hidden">Menü</span></a>
			</section>
			
		</header>
		
				
		<!-- mobile menu-->
		<div id="nav-mobile">
			<div class="nav-mobile-view">
				<a class="switch-menu" href="#header"><span class="fa fa-times"></span>Menü schließen</a>
				
				<div class="logo">
					<img src="<?php echo get_template_directory_uri(); ?>/lib/images/logo_small.png" width="500" height="500" alt="<?php bloginfo('name'); ?>">
					<h2><?php bloginfo('name'); ?></h2>
					<span class="clearfix"></span>
				</div>
				
				<?php get_search_form(); ?>
				<nav role="navigation" class=""><h6 class="unsichtbar">Hauptmenü für Mobilgeräte:</h6><?php kr8_nav_mobile(); ?></nav>
			</div>
			<div class="mobile-overlay"></div>
		</div>	

		<!-- fixed desktop menu flyin-->
		<div class="nav-wrap" id="nav-flyin"><div class="inner">
			<div class="logo-desktop">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Zur Startseite"><img src="<?php echo get_template_directory_uri(); ?>/lib/images/logo_small.png" width="500" height="500" alt="<?php bloginfo('name'); ?>"></a>
				<h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Zur Startseite"><?php bloginfo('name'); ?></a></h2>
			</div>
			<nav role="navigation" class="nav-main"><h6 class="unsichtbar">Hauptmenü für Desktop-Computer:</h6><?php kr8_nav_main(); ?></nav>
		</div></div>			
		
		
		
		<div class="search-desktop" id="suche"><div class="inner">
		<?php get_search_form(); ?>
		<a href="#header"><i class="fa fa-times"></i> Suche schließen</a>
		</div></div>
			
			
			<!-- normal desktop menu -->
			<div class="nav-wrap inner" id="nav-desktop">
				<nav role="navigation" class="nav-main" id="hauptmenue"><h6 class="unsichtbar">Hauptmenü:</h6>
					<?php kr8_nav_main(); ?>
				</nav>
				<?php // if (function_exists('nav_breadcrumb') ) nav_breadcrumb(); ?>
			</div>
						
