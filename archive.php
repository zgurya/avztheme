<?php get_header(); ?>
<main class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1><?php echo get_the_archive_title();?></h1>
		</div>
	</div>
	<div class="row">
		<?php if ( have_posts() ) :?>
			<?php while ( have_posts() ) : the_post();?>
				<article <?php post_class('col-xs-12 col-sm-6 col-md-3'); ?>>
					<h2><?php the_title();?></h2>
					<?php the_post_thumbnail();?>
					<?php echo wp_trim_words( strip_shortcodes(get_the_content()), 20, '...' );?>
				</article>
			<?php endwhile;?>
		<?php endif;?>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php avztheme_pagination();?>
		</div>
	</div>
</main>
<?php get_footer(); ?>