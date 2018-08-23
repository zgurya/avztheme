<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
	<?php if(get_field('theme_options_favicon','option')):?>
		<link rel="shortcut icon" href="<?php the_field('theme_options_favicon','option');?>" type="image/x-icon">
		<link rel="icon" href="<?php the_field('theme_options_favicon','option');?>" type="image/x-icon">
	<?php endif;?>
	<?php wp_head(); ?>
	<?php the_field('theme_options_code_in_head','option');?>
</head>
<body <?php body_class();?>>
<header class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php wp_nav_menu( array( 'theme_location' => 'mainmenu', 'menu_id' => 'mainmenu', 'inner' => '', 'container'=>'') ); ?>	
		</div>
	</div>
</header>