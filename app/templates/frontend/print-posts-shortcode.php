<?php if ( $fetched_posts->have_posts() ) : ?>
	<?php
	while ( $fetched_posts->have_posts() ) :
		$fetched_posts->the_post();
		?>
		<h2> <?php the_title(); ?> </h2>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
<?php else : ?>
	<p> <?php esc_html_e( 'Sorry, no posts found!' ); ?>
<?php endif; ?>
