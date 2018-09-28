<?php
/**
 * Template name: Annonces
 *
 *
 *
 * @package theme-personalise
 */


$args = array('post_per_page' => '-1', 'post_type'=>'annonces');
$mesAnnonces = new WP_Query($args);

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// We should never have comments here
			// if ( comments_open() || get_comments_number() ) :
				// comments_template();
            // endif;
            // 

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
