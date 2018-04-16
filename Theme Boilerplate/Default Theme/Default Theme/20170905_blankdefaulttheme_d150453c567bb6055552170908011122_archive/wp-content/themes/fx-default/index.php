<?php
/**
 * The homepage template file.
 *
 *
 * @package fx
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="row">
			<div class="medium-9 small-12 columns">
				<h1><?= wp_title() ?></h1>
				<?php                		
				if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="post">
						<div class="post-content">
							<h2 class="title"><a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a></h2>
							<div class="entry-metadata">
								<?= get_the_date(); ?>
							</div>										
							<div class="the-content">
								<?php the_excerpt(); ?>							
							</div>
						</div>	
					</article>
				<?php endwhile; ?>
				<?php
						//if ( comments_open() || '0' != get_comments_number() )
						//	comments_template( '', true );
				?>
				<?php else : ?>	
	<!-- 					<article class="post error">
						<h1 class="404">Nothing has been posted like that yet</h1>
					</article> -->
				<?php endif; ?>
				<?php 
					global $wp_query;

					$big = 999999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages
					) );
				?>
			</div>
			<div class="medium-3 small-12 columns">
				<?php get_sidebar(); ?>
			</div>
		</div>	
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
