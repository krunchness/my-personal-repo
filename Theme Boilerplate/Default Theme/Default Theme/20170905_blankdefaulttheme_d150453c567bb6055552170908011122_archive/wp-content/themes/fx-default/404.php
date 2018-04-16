<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package fx
 */

get_header(); ?>

	<div id="primary" class="content-area ws-tall">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="row">
					<div class="large-12 twelve columns">
						<h1>404</h1>
						<h2>The page you are looking for cannot be found. Try going to our <a href="<?php echo site_url();?>">homepage</a>.</h2>
					</div>
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
