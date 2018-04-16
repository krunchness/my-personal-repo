<ul>
	<?php
	global $fx_data;

	$slides = $fx_data['slider'];
	foreach($slides as $slide) :
		$slide_count++;
	$slide_title = $slide['title'];
	$slide_desc = $slide['description'];
	$slide_img = $slide['image'];
	$slide_link = $slide['url'];
	$attachment_id = get_attachment_id_from_src($slide_img);	
	$title_text = get_the_title($attachment_id);
	$alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true); 
	?>
	<li style="background: url('<?php echo $slide_img ?>')">
		<!-- <img class="banner_img" src="<?php //echo $feat_img ?>" title="<?php // echo $title_text ?>" alt="<?php //echo $alt_text ?>" /> -->
		<div class="slider-inner">
			<div class="caption-container">
				<div id="inner-box">
					<div class="row">
						<div class="medium-5 columns">
							<div id="content">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</li>
<?php endforeach; ?>
</ul>				

