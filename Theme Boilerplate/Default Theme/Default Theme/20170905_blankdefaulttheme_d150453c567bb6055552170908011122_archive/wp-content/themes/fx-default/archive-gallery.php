<?php
get_header();
?>
<div id="primary" class="content-area ws-short">
	<main id="main" class="site-main" role="main">	
		<div class="row">
			<div class="small-12 columns">
				<?php custom_breadcrumbs(); ?>
				<?php the_title('<h1 class="post-title" data-page-id="'.get_the_ID().'"><span>','</span></h1>'); ?>
			</div> <!-- small-12 columns -->
		</div> <!-- row -->
		<div class="row small-up-1 medium-up-3">
			<?php 
			$gallery = new WP_Query(array(
				'post_type' 	=> 'gallery',
				'post_status' 	=> 'publish',
				'order'   => 'ASC',
				'posts_per_page' => -1
				));
			$a= 0;
			if($gallery->have_posts()):
				while($gallery->have_posts()): $gallery->the_post();
			$a++;
			$thumbnail = (get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $fx_data['gallery_thumbnail']['url']);
			$img_title = get_the_title(get_attachment_id_from_src($thumbnail));
			?>
			<div class="figure-holder column column-block">
				<figure>
					<a href="<?= the_permalink() ?>">
						<div class="img-wrapper">
							<img src="<?= aq_resize($thumbnail, 270, 300) ?>" title="<?= $img_title ?>" alt="<?= $img_title ?>">
						</div> <!-- .img-wrapper -->
						<figcaption>	
							<h3><?= the_title() ?></h3>
						</figcaption>
					</a>
				</figure>
			</div> <!-- .figure-holder .column .column-block -->
			<?php 
			endwhile; 
			endif;
			?>  	
		</div>
	</main>
</div> <!-- #gallery-page -->
<?php 
get_footer();

?>
