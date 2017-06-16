<?php 
/* 
 * Template Name: Page with sidebar 
 */
?>
<?php get_header(); ?>
<main  class="container">
	<div class="row">
		<div class="col-xs-8">
			<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post();?>
					<article>
						<h1><?php the_title();?></h1>
						<?php the_content();?>
					</article>
				<?php endwhile;?>
			<?php endif;?>
		</div>
		<div class="col-xs-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
