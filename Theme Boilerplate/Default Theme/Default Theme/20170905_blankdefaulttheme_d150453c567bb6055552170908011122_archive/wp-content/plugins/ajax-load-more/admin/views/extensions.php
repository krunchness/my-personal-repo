<div class="admin ajax-load-more" id="alm-add-ons">
	<div class="wrap">
		<div class="header-wrap">
	   		<h1>
   	   		<?php echo ALM_TITLE; ?>: <strong><?php _e('Extensions', 'ajax-load-more'); ?></strong>
               <em><?php _e('Free extensions that provide compatibility with popular plugins and core WordPress functionality', 'ajax-load-more'); ?>.</em>
	   		</h1>
		</div>
		
		<div class="cnkt-main full">

			<?php
   			
   			$plugin_array = array(   			
					array(
						'slug' => 'ajax-load-more-for-acf',
					),
					array(
						'slug' => 'ajax-load-more-for-relevanssi',
					),
					array(
						'slug' => 'ajax-load-more-rest-api'
					),
					array(
						'slug' => 'ajax-load-more-for-searchwp'
					)
				);	
				   			
   			if(class_exists('Connekt_Plugin_Installer')){
   			   Connekt_Plugin_Installer::init($plugin_array);
   			}	

			?>   
         

	   </div>

		<div class="call-out light" style="width: 100%;">
		   <p><?php _e('Extensions are installed as stand alone plugins and receive update notifications in the <a href="plugins.php">plugin dashboard</a>.', 'ajax-load-more'); ?></p>
   	</div>

	</div>
</div>