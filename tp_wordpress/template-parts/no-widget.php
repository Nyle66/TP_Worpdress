<?php
/*
*
Template Name: No-Widgets
*/
get_header(); 
$pop = get_option("custom_pop");
if(isset($pop["page"])){
	if($pop["page"] == 1){
		echo "<script>alert(\"POP-UP DE PAGE\")</script>";
	}
};
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();