<?php get_header(); ?>
<main class="container">
	<div class="row">
		<?php if ( have_posts() ) :?>
			<?php while ( have_posts() ) : the_post();?>
				<article <?php post_class('col-xs-12'); ?>>
					<h1><?php the_title();?></h1>
					<?php the_post_thumbnail();?>
					<?php the_content();?>
				</article>
			<?php endwhile;?>
		<?php endif;?>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php if ( comments_open() || get_comments_number() ) comments_template();?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php the_tags( 'Tags: ', ', ', '' ); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>