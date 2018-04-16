 <?php
/**
 * Template Name: FAQS 
 *
 * @package fx
 */

get_header(); ?>
<?php get_template_part('template-parts/content', 'page-banner' ); ?>
<div id="primary" class="content-area ws-short">
	<main id="main" class="site-main" role="main">	
		<div class="row">
			<div class="small-12 columns">
				<?php custom_breadcrumbs(); ?>
				<?php while ( have_posts() ) : the_post(); 
					the_title('<h1>', '</h1>'); 
				?>
					<div class="the-content">
						<?php the_content(); ?>											
						<?php 
						$faqs = get_post_meta(get_the_ID(), "cmb_faqs", true);
						if($faqs):
							echo "<div class='faq-list'>";
						foreach($faqs as $faq):
							echo "<div class='accordion-btn'>".$faq['question']."</div>";
						echo "<div class='accordion-content'>".apply_filters("the_content", $faq['answer'])."</div>";			
						endforeach;
						echo "</div>";
						endif;
						?>
					<?php endwhile; // End of the loop. ?>
				</div>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->	
<?php get_footer(); ?>
