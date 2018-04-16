<?php get_header();  
global $fx_data;
?>
<div class="row vsize <?= ($fx_data['qe_fullwidth'] ? 'gallery-fullwidth' : '') ?>" id="gallery">	
		<div class="small-12 columns">
			<?php custom_breadcrumbs(); ?>
			<h1 class="post-title" data-page-id="<?=  get_the_ID() ?>"><?= get_the_title() ?></h1>				
			<?php 
			$images = get_post_meta(get_the_ID(), "cmb_file_list", true); 
			$counter = 0;
			?>
			<div id="grid-gallery">
				<?php foreach($images as $image):
					$title = get_the_title(get_attachment_id_from_src($image));
				?>
				<?php if($counter < 5 ): ?>
					<div class="grid-image <?= ($fx_data['qe_column'] ? $fx_data['qe_column'] : 'grid-4' ) ?>">
						<a href="<?= $image ?>" data-lightbox="gallery"><img src="<?= $image ?>" title="<?= $title ?>" alt="<?= $title ?>"></a>
					</div>
				<?php endif; $counter++;?>
				<?php endforeach; ?>
			</div>
		</div>
	<div class="load-more"></div>
</div>
<script>
	jQuery(document).ready(function($){

		var $gallery_grid = $('#grid-gallery').isotope({
		  // options    
		  itemSelector: '.grid-image',
		  percentPosition: true,
		  masonry: {
		  	columnWidth: '.grid-image'
		  }   
		}); 

		$gallery_grid.imagesLoaded().progress( function() {
			$gallery_grid.isotope('layout');
		});

		var loading = false;    
		$(window).scroll(function(e) {
			if(loading == false && $('.load-more').length > 0){       
				var scroll = $(window).scrollTop() + jQuery(window).height();
				var bottom = $('.load-more').offset().top;
				var postoffset = $('.grid-image').length;
				var page_id = $("#gallery h1").attr('data-page-id'); 
            if(scroll>bottom){
            	loading = true;
                $('.loading').fadeIn(600);
                $.ajax({
                	url : ajax_object.ajax_url,
                	type : 'post',
                	data : { 
                		action : 'gallery_images',
                		postoffset : postoffset,
                		page_id : page_id
                	},
                	success : function( response ) {
                		$gallery_grid
                		.isotope( 'insert', $(response) );
                		$gallery_grid.imagesLoaded().progress( function() {
                			$gallery_grid.isotope('layout');
                		});
                		$('.ajax-load').remove();                           
                		loading = false;
                	}
                });
            }
        }   
    });	
	});    
</script>		
<?php get_footer(); ?>


