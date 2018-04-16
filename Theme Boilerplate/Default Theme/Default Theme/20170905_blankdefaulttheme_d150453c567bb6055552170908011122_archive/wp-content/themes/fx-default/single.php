<?php
/**
 *
 * @package fx
 */

get_header(); ?>
	<div id="primary" class="single-content-area ws-short">
		<main id="main" class="site-main" role="main">
			<div class="row">
				<div class="large-12 columns">
					<?php custom_breadcrumbs(); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<header class="entry-header">
							<?php 
								$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
	
								if(!$image):
							?>
								<h1 class="article-heading"><?php the_title(); ?></h1>
							<?php
								endif;
							?>
						</header><!-- .entry-header -->
						
						<div class="entry-metadata">
							<?php echo get_the_date(); ?>
						</div>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<div class="entry-comment">
							<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							?>
						</div>
						<nav class="navigation post-navigation" role="navigation">
							<div class="nav-links">
								<div id="nav-previous">
								<?php
								$prev_post = get_next_post();
								if($prev_post) {
								$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
								echo "\t" . '<div class="nav-previous"><a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title . '" class=" ">&laquo; '. $prev_title .'</a></div>' . "\n";
												}
								$next_post = get_previous_post();
								if($next_post) {
								$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
								echo "\t" . '<div class="nav-next"><a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title . '" class=" ">' . $next_title . ' &raquo;</a></div>' . "\n";
												}
								?>
								</div>
							</div>
						</nav>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
