<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">  
  
  <header id="header" class="site-header" role="banner">
      
      <div class="container_16 container_header_top clearfix">
        <div class="grid_16">
		  <?php //get_template_part( 'custom', 'header' ); ?>
        <h1 class="ciaccoH1"><a href="http://em.qbdp.me/devlog">CiaccoDavide's Dev (B)Log</a></h1>
        <p class="shell"><span class="user">ciaccodavide</span>@<span class="doamin">devlog</span>:<?php echo esc_attr(add_query_arg( NULL, NULL )); ?>#<span class="blinking">▮</span></p>
        </div>
      </div>
      
      
      <div class="container_16 clearfix">
        <div class="grid_16">
          <nav id="nav" class="main-navigation" role="navigation">
            <?php prana_primary_menu(); ?>
          </nav>
        </div>
      </div>
  
  </header>
