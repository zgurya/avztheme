<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>
<header class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary', 'inner' => '', 'container'=>'') ); ?>	
		</div>
	</div>
</header>