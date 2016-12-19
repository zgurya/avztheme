<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
	<aside id="right-sidebar">
		<ul>
			<?php dynamic_sidebar( 'right-sidebar' );?>
		</ul>
	</aside>
<?php endif; ?>