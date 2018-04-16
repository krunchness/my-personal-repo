<?php
/**
 * The template for displaying all pages.
 *
 *
 * @package fx
 */

get_header(); ?>
<?php 
if(get_the_post_thumbnail_url()): 
	?>
<div class="page-banner" style="background-image: url(<?= get_the_post_thumbnail_url() ?>)" ></div>
<?php 
endif; 
?>
<div id="primary" class="content-area ws-short">
	<main id="main" class="site-main" role="main">
		<div class="row">
			<div class="large-12 columns">
				<?php
				custom_breadcrumbs();
				while ( have_posts() ) : the_post(); 
				the_title('<h1>', '</h1>'); 
				the_content(); 
				endwhile; // end of the loop. 
				?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
