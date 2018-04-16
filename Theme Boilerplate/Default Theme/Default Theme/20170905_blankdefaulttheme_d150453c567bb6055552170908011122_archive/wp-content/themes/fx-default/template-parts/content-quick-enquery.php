<?php global $fx_data ?>
<div id="quick-enquiry">
	<a data-remodal-target="qck-enquery-modal" class="remodal-thebutton"><?= $fx_data['qe_button_text'] ?></a>
	<div class="remodal remodal-thecontent" data-remodal-id="qck-enquery-modal"  data-remodal-options="hashTracking: false" >
		<button data-remodal-action="close" class="remodal-close"></button>
		<!-- <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button> -->
		<!-- <button data-remodal-action="confirm" class="remodal-confirm">OK</button> -->
		<div class="row mobile">
			<div class="large-12 columns">
				<h3 class="form-heading"><?= $fx_data['qe_heading'] ?></h3>
				<p class="form-subheading"><?= $fx_data['qe_paragraph'] ?><p>
					<div class="form-content">
						<?= do_shortcode($fx_data['qe_shortcode']); ?>  		
					</div>
			</div>
		</div>              
	</div>
</div>