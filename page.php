<?php get_header(); ?>
<main class="container">
	<div class="row">
		<?php if ( have_posts() ) :?>
			<?php while ( have_posts() ) : the_post();?>
				<article <?php post_class('col-lg-12'); ?>>
					<h1><?php the_title();?></h1>
					<?php the_content();?>
				</article>
			<?php endwhile;?>
		<?php endif;?>
	</div>
	<div class="row">
		<?php if ( comments_open() || get_comments_number() ) comments_template();?>
	</div>
</main>
<?php get_footer(); ?>