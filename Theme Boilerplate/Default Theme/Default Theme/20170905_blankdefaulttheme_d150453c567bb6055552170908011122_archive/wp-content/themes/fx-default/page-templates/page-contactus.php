<?php
/*
*
* Template Name: Contact Us
*
*/
get_header();  ?>
	<div id="primary" class="content-area ws-short">
		<main id="main" class="site-main" role="main">
			<?php 
				$map = get_post_meta($post->ID, 'cmb_gmap', true );
				if($map):
			?>
				<div class="contact-page-map">
					<?= $map ?>
				</div>
			<?php
				 endif;
			?>
			<div class="row">
				<div class="large-12 large-centered columns">
					<div class="heading"><?php the_title('<h1>', '</h1>'); ?></div>
				</div>
				<div class="large-8 columns">
					<?php 
						while ( have_posts() ) : the_post(); 							
							the_content(); 
						endwhile; // end of the loop. 
					 ?>
				</div>
				<div class="large-4 columns">
					<div class="contact-sidebar">
						<?php dynamic_sidebar('contact-sidebar'); ?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>