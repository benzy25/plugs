<!DOCTYPE html>
<html class="no-js">
<head>
	<title><?php wp_title('•', true, 'right'); bloginfo('name'); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!--[if lt IE 8]>
<div class="alert alert-warning">
	You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
</div>
<![endif]-->
<header id="masthead" role="banner">
<div class="container">
	<div id="dia-logo-left">
	<a href="<?php echo site_url(); ?>"><img src="<?php echo site_url(); ?>/wp-content/imgs/DiaMedical-Logo-main.png" /></a>
	</div>
	<?php get_template_part('includes/navbar-search'); ?>
	<?php
			wp_nav_menu( array(
					'theme_location'    => 'navbar-left',
					'depth'             => 2,
					'menu_class'        => 'nav navbar-nav navbar-left',
					'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					'walker'            => new wp_bootstrap_navwalker())
			);
	?>
</div>
</header>

<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">

			<?php
$benzitems = '<ul id="%1$s" class="%2$s sf-menu sf-js-enabled">%3$s</ul>';
$benzmenu  = 'benz-menu';
wp_nav_menu(array(
    'theme_location' => 'home',
    'items_wrap' => $benzitems,
    'container_class' => $benzmenu
    //  'walker'          => new BENZ_Walker_Nav_Menu_MATT
));
wp_nav_menu(array(
    'theme_location' => 'medical-equipment',
    'items_wrap' => $benzitems,
    'container_class' => $benzmenu . ' ' . $benzmenu . '-equipt'
    //  'walker'          => new BENZ_Walker_Nav_Menu_MATT
));
wp_nav_menu(array(
    'theme_location' => 'parts-search',
    'items_wrap' => $benzitems,
    'container_class' => $benzmenu . ' ' . $benzmenu . '-parts'
    //  'walker'          => new BENZ_Walker_Nav_Menu_MATT
));
wp_nav_menu(array(
    'theme_location' => 'repairs',
    'items_wrap' => $benzitems,
    'container_class' => $benzmenu . ' ' . $benzmenu . '-repairs'
    //  'walker'          => new BENZ_Walker_Nav_Menu_MATT
));
wp_nav_menu(array(
    'theme_location' => 'manufacturers',
    'items_wrap' => $benzitems,
    'container_class' => $benzmenu . ' ' . $benzmenu . '-manufacturers'
    //  'walker'          => new BENZ_Walker_Nav_Menu_MFT
));
wp_nav_menu(array(
    'theme_location' => 'about-us',
    'items_wrap' => $benzitems,
    'container_class' => $benzmenu . ' ' . $benzmenu . '-about'
    // 'walker'          => new BENZ_Walker_Nav_Menu_ABOUT
));
?>

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

		</div><!-- .navbar-header -->
    <div class="collapse navbar-collapse" id="navbar">
      <?php
            wp_nav_menu( array(
                'theme_location'    => 'navbar-left',
                'depth'             => 2,
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
