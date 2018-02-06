<?php 

/**
 * Scanner Class of the Plugin
 *
 * Loads and defines every Functions if the user clicked the "scan" button.
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
# get_search_engine()
# check_wordpress_version()
# check_plugins_test()
# check_files()
# get_wp_table()
# check_fx_user()
# get_permalink_structure()
# user_capabilities()
# check_domain()
# misc_wordpress()
# woocommerce_settings()
# check_plugin_versions()
# contact_form()
# wordpress_settings()

--------------------------------------------------------------*/
class Scanner
{

	public function test(){
		global $wpdb;
		$search_engine_opt = $wpdb->get_var( "SELECT option_value FROM $wpdb->options WHERE option_id = 51" );

		ob_start(); ?>
			<?php if ($search_engine_opt == 1): ?>
				<div class="container">
					<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
				    <p class="test-title">Search Engine Visibility : Enabled </p>
				</div>
			<?php else: ?>
				<div class="container">
					<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
				    <p class="test-title">Search Engine Visibility : Disabled </p>
				    <?php echo $search_engine_opt; ?>
				</div>
			<?php endif ?>
		<?php return ob_get_clean(); ?>
	<?php }

	public function get_search_engine($server){
		global $wpdb;
		$search_engine_opt = $wpdb->get_var( "SELECT option_value FROM $wpdb->options WHERE option_id = 51" );
		ob_start(); ?>
			<?php if ($server == 'preview'): ?>
				<?php if ($search_engine_opt == 0): ?>
					<div class="container">
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
					    <p class="test-title">Search Engine Visibility : Disabled </p>
					</div>
				<?php else: ?>
					<div class="container">
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
					    <p class="test-title">Search Engine Visibility : Enabled </p>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<?php if ($search_engine_opt == 1): ?>
					<div class="container">
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
					    <p class="test-title">Search Engine Visibility : Enabled </p>
					</div>
				<?php else: ?>
					<div class="container">
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
					    <p class="test-title">Search Engine Visibility : Disabled </p>
					</div>
				<?php endif; ?>
			<?php endif ?>
			<!-- <?php// if (strpos( get_bloginfo('url'), 'preview.net.au' ) !== false): ?>
				<?php //if ($search_engine_opt == 0): ?>
					<div class="container">
						<img src="<?php// echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
					    <p class="test-title">Search Engine Visibility : Disabled </p>
					</div>
				<?php //else: ?>
					<div class="container">
						<img src="<?php// echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
					    <p class="test-title">Search Engine Visibility : Enabled </p>
					</div>
				<?php //endif; ?>
			<?php //else: ?>
				<?php //if ($search_engine_opt == 1): ?>
					<div class="container">
						<img src="<?php //echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
					    <p class="test-title">Search Engine Visibility : Enabled </p>
					</div>
				<?php //else: ?>
					<div class="container">
						<img src="<?php// echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
					    <p class="test-title">Search Engine Visibility : Disabled </p>
					</div>
				<?//php endif; ?>
			<?php// endif; ?> -->
		<?php return ob_get_clean(); ?>
	<?php }

	public function check_wordpress_version(){
		$url = 'https://api.wordpress.org/core/version-check/1.7/';
		$response = wp_remote_get($url);

		$json = $response['body'];
		$obj = json_decode($json);
		$upgrade = $obj->offers[0];
		ob_start(); ?>

		<?php if (get_bloginfo('version') == $upgrade->version): ?>
			<div class="container">
				<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
			    <p class="test-title">You're Running the Latest Wordpress Version : <?php bloginfo('version'); ?> </p>
			</div>
		<?php else: ?>
			<div class="container">
			    <img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
			    <p class="test-title">Current Wordpress Version : <?php bloginfo('version'); ?> </br> Latest Version : <?php echo $upgrade->version; ?> </p>
			</div>
		<?php endif ?>
			<div class=""></div>
		<?php return ob_get_clean(); ?>
	<?php }

	public function check_plugins_test($websiteType){
		// $plugin_name = ['change-table-prefix'];
		$plugin_name = array(
			array(
				"name" => 'Change Table Prefix',
				'plugin_file' => 'change-table-prefix',
				'folder_name' => 'change-table-prefix'
			),array(
				"name" => 'Woocommerce',
				'plugin_file' => 'woocommerce',
				'folder_name' => 'woocommerce'
			),array(
				"name" => 'All in One WP Security',
				'plugin_file' => 'wp-security',
				'folder_name' => 'all-in-one-wp-security-and-firewall'
			),array(
				"name" => 'Yoast SEO',
				'plugin_file' => 'wp-seo',
				'folder_name' => 'wordpress-seo'
			),array(
				"name" => 'User Role Editor',
				'plugin_file' => 'user-role-editor',
				'folder_name' => 'user-role-editor'
			),array(
				"name" => 'WP Smush',
				'plugin_file' => 'wp-smush',
				'folder_name' => 'wp-smushit'
			),array(
				"name" => 'Contact Form 7',
				'plugin_file' => 'wp-contact-form-7',
				'folder_name' => 'contact-form-7'
			),array(
				"name" => 'No Comment',
				'plugin_file' => 'no-comments',
				'folder_name' => 'no-comments'
			),
		);
		ob_start(); ?>

		<div class="table-wrapper">
			<h2>Required Plugins</h2>
			<table class="table-title">
		
			  <tr>
			    <th>Status</th>
			    <th>Plugin Name</th>
			    <th>Plugin Status</th>
			    <th>Solution</th>
			  </tr>
		<?php foreach ($plugin_name as $name): ?>
			<?php $plugin_Basename = get_plugins(); ?>
		    <?php if($name['name'] == 'Woocommerce'): ?>
		    	<?php if($websiteType == 'woocommerce'): ?>
		    		<?php if (is_plugin_active( $name['folder_name'].'/'.$name['plugin_file'].'.php' )): ?>
					<tr>
				    	<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
				    	<td><?php echo $name['name']; ?></td>
				    	<td>Active</td>
				    </tr>
				    <?php elseif (!is_null($plugin_Basename[$name['folder_name'].'/'.$name['plugin_file'].'.php']) ): ?>
				    <tr>
				    	<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
				    	<td><?php echo $name['name']; ?></td>
				    	<td>Not Active</td>
				    </tr>
					<?php else: ?>
					<tr>
				    	<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
				    	<td><?php echo $name['name']; ?></td>
				    	<td>Not Installed</td>
				    </tr>
					<?php endif; ?>
		    	<?php endif; ?>
			<?php elseif (is_plugin_active( $name['folder_name'].'/'.$name['plugin_file'].'.php' )): ?>
				<tr>
					<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
			    	<td><?php echo $name['name']; ?></td>
			    	<td>Active</td>
		    	</tr>
			<?php else: ?>
				<?php if (!is_null($plugin_Basename[$name['folder_name'].'/'.$name['plugin_file'].'.php']) ): ?>
					<tr>
				    	<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
				    	<td><?php echo $name['name']; ?></td>
				    	<td>Not Active</td>
				    </tr>
				<?php else: ?>
					<tr>
				    	<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
				    	<td><?php echo $name['name']; ?></td>
				    	<td>Not Installed</td>
				    </tr>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
			</table>
		</div>
		<?php return ob_get_clean(); ?>

	<?php }

	public function deactivated_plugins(){
		ob_start(); ?>

			<?php $all_plugins = get_plugins(); 
			$plugins_count = count($all_plugins);
			$count = 0;?>
			<div class="table-wrapper">
				<h2>Unused Plugins</h2>
				<table class="table-title">
			
				  <tr>
				  	<th>ID</th>
				    <th>Status</th>
				    <th>Plugin Name</th>
				    <th>Plugin Status</th>
				    <th>Solution</th>
				  </tr>
					<?php foreach ($all_plugins as $key => $plugin): ?>
						<?php if (!is_plugin_active($key)): ?>
							<?php $count++; ?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
								<td><?php echo $plugin['Name']; ?></td>
								<td>Not Activated</td>
							</tr>
						<?php else: ?>
							<?php $plugins_count--; ?>
						<?php endif; ?>
					<?php endforeach; ?>

					<?php if ($plugins_count == 0): ?>
						<tr>
						    <td colspan="5">
						    	<p class="error-msg">No Unused Plugins</p>
						    </td>
					    </tr>		
					<?php endif ?>		
				</table>
			</div>

			
		<?php return ob_get_clean(); ?>
	<?php }
	public function check_files(){
		$path = get_home_path().'/changelog.txt';
		$error_log = get_home_path().'/error_log';
		ob_start();?>

		<div class="table-wrapper">
			<h2><?php echo strtoupper($brand_user['abbreviation']); ?> Webmaster Account</h2>
			<table class="table-title">
				<tr>
				    <th>Status</th>
				    <th>Label</th>
				    <th>Value</th>
				    <th>Solution</th>
				</tr>

				<tr>
					<?php if (file_exists($path)): ?>
			    		<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
			    		<td>Changelog File</td>
			    		<td>Existing File</td>
					<?php else: ?>
			    		<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
			    		<td>Changelog File</td>
			    		<td>No Existing File</td>
					<?php endif; ?>
				</tr>
				<tr>
					<?php if (file_exists($error_log)): ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
				    	<td>Error Log File</td>
				    	<td>Existing File</td>
					<?php else: ?>
			    		<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
			    		<td>Error Log File</td>
			    		<td>No Existing File</td>
					<?php endif; ?>
				</tr>
				
				<!-- Issue: cant find the file -->
				<tr>
					<?php if (file_exists(get_template_directory_uri().'/images/favicon.ico') || file_exists(get_template_directory_uri().'/favicon.ico') || file_exists(get_template_directory_uri().'/favicon.png') || file_exists(get_template_directory_uri().'/images/favicon.png')): ?>
						<td><img src="<?php echo  plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
						<td>Favicon.ico</td> 
						<td>File Exist</td>
					<?php else: ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
						<td>Favicon.ico</td>
						<td>No Existing File</td>
					<?php endif; ?>
				</tr>

				<!-- Issue: cant find the file -->
				<tr>
					<?php if (file_exists(get_template_directory_uri().'/screenshot.png')): ?>
						<td><img src="<?php echo  plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
						<td>Screenshot.png</td> 
						<td>File Exist</td>
					<?php else: ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
						<td>Screenshot.png</td>
						<td>No Existing File</td>
					<?php endif; ?>
				</tr>
			</table>
		</div>

		<?php return ob_get_clean(); ?>
	<?php }

	public function get_wp_prefix($brand){
		global $wpdb;
		$prefix = $wpdb->prefix;

		ob_start();?>

		<?php if ($prefix == $brand['abbreviation'].'wp_'): ?>
			<div class="container">
	    		<img src="<?php echo  plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
	    		<p class="test-title">WP Table Prefix is : <?php echo $prefix; ?></p>
	    	</div>
		<?php else: ?>
			<div class="container">
	    		<img src="<?php echo  plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon wp-prefix">
	    		<p class="test-title">WP Table Prefix is not '<?php echo $brand['abbreviation'].'wp_';  ?>'</p>
	    	</div>
		<?php endif; ?>

		<?php return ob_get_clean(); ?>
	<?php } 

	public function get_wp_table(){
		$path = get_home_path().'wp-config.php';
	
		$prefix = "'fxwp_'";
		$table = '$table_prefix  = '.$prefix;

		$file = file_get_contents($path);

		ob_start();?>

		<?php if (strpos($file, $table ) !== false): ?>
			<div class="container">
	    		<img src="<?php echo  plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon wp-prefix">
	    		<p class="test-title">WP Table Prefix : <?php echo $prefix; ?></p>
	    	</div>
		<?php else: ?>
			<div class="container">
	    		<img src="<?php echo  plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon wp-prefix">
	    		<p class="test-title">WP Table Prefix is not <?php echo $prefix; ?></p>
	    	</div>
		<?php endif; ?>

		<?php return ob_get_clean(); ?>
	<?php }

	public function check_fx_user($brand_user){
		// var_dump($brand_user);

		global $wpdb;
		$marketing_user = $brand_user['abbreviation'].'-marketer';
		$marketer = get_users( array( 'search' => '*'.$marketing_user.'*' ) );

		$fx_user = get_users(['search' => $brand_user['name']]);
		$fx_user_data = get_userdata( $fx_user[0]->id );
		$fx_user_meta = get_user_meta($fx_user[0]->id);
		$check_icon = plugins_url().'/fxbp-scanner/public/images/check.png';
		$x_cross = plugins_url().'/fxbp-scanner/public/images/x.png';

		$all_users = $wpdb->get_results("SELECT * FROM $wpdb->users");

		
			ob_start();  ?>

				<div class="table-wrapper">
					<h2><?php echo strtoupper($brand_user['abbreviation']); ?> Webmaster Account</h2>
					<table class="table-title">
				
					  <tr>
					    <th>Status</th>
					    <th>Label</th>
					    <th>Value</th>
					    <th>Solution</th>
					  </tr>

				<?php if (!empty($fx_user)): ?>
				  	<?php if(strpos($fx_user[0]->user_login, $brand_user['abbreviation'].'-webmaster' ) !== false): ?>
						<td><img src="<?php echo $check_icon; ?>"></td>
					<?php else: ?>
						<td><img src="<?php echo $x_cross; ?>" class="test-icon"></td>
					<?php endif; ?>
						<td><?php echo strtoupper($brand_user['abbreviation']); ?> Username</td>
					    <td><?php echo $fx_user[0]->user_nicename; ?></td>
					    <td>Solution</td>
					  </tr>

					  <tr>
					  	<?php if ($fx_user[0]->user_email == $brand_user['email']): ?>
							<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
						<?php endif; ?>
				    		<td><?php echo strtoupper($brand_user['abbreviation']); ?> Email</td>
				    		<td><?php echo $fx_user[0]->user_email; ?></td>
				    		<td>Solution</td>
					  </tr>

					  <tr>
						<?php if ($fx_user[0]->display_name == $brand_user['name']): ?>
							<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
						<?php endif; ?>
				    		<td><?php echo strtoupper($brand_user['abbreviation']); ?> Display Name</td>
				    		<td><?php echo $fx_user[0]->display_name; ?></td>
				    		<td>Solution</td>
					  </tr>

					  <tr>
					  	<?php if ($fx_user_meta['first_name'][0] == $brand_user['name']): ?>
							<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
						<?php endif; ?>
				    		<td><?php echo strtoupper($brand_user['abbreviation']); ?> First Name</td>
				    		<td><?php echo $fx_user_meta['first_name'][0]; ?></td>
					  </tr>

					  <tr>
					  	<?php if ($fx_user[0]->user_url == $brand_user['urlLink']): ?>
								<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
							<?php else: ?>
								<img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix">
							<?php endif; ?>
							<td><?php echo strtoupper($brand_user['abbreviation']); ?> Website URL</td>
							<td><?php echo $fx_user[0]->user_url; ?></td>
					  </tr>

					  <tr>
					  	<?php if ($fx_user_data->roles[0] == 'administrator'): ?>
							<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
						<?php endif; ?>
						<td><?php echo strtoupper($brand_user['abbreviation']); ?> Account Role</td>
						<td><?php echo $fx_user_data->roles[0]; ?></td>

					  </tr>
				<?php else: ?>
				    <tr>
					    <td colspan="6">
					    	<p class="error-msg"><?php echo strtoupper($brand_user['abbreviation']); ?> Webmaster Account Doesn't Exist</p>
					    </td>
				    </tr>
				<?php endif; ?>
					</table>
				</div>
			

			<div class="table-wrapper">
				<h2><?php echo strtoupper($brand_user['abbreviation']); ?> Marketing Account</h2>
				<table class="table-title">
				  <tr>
				    <th>Status</th>
				    <th>Label</th>
				    <th>Value</th>
				    <th>Solution</th>
				  </tr>

			<?php if (!empty($marketer)): ?>

				  	<?php if(strpos($marketer[0]->data->user_login, $brand_user['abbreviation'].'-marketer' ) !== false): ?>
						<td><img src="<?php echo $check_icon; ?>"></td>
					<?php else: ?>
						<td><img src="<?php echo $x_cross; ?>" class="test-icon"></td>
					<?php endif; ?>
						<td><p class="test-title"><?php echo strtoupper($brand_user['abbreviation']); ?> Username</td>
					    <td><?php echo $marketer[0]->data->user_login; ?></td>
					    <td>Solution</td>
					  </tr>


					  <tr>
					  	<?php if ($fx_user[0]->user_email == $brand_user['email']): ?>
							<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
						<?php endif; ?>
				    		<td><?php echo strtoupper($brand_user['abbreviation']); ?> Email</td>
				    		<td><?php echo $fx_user[0]->user_email; ?></td>
				    		<td>Solution</td>
					  </tr>

					  <tr>
						<?php if ($fx_user[0]->display_name == $brand_user['name']): ?>
							<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
						<?php endif; ?>
				    		<td><?php echo strtoupper($brand_user['abbreviation']); ?> Display Name</td>
				    		<td><?php echo $fx_user[0]->display_name; ?></td>
				    		<td>Solution</td>
					  </tr>

					  <tr>
					  	<?php if ($fx_user_meta['first_name'][0] == $brand_user['name']): ?>
							<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
						<?php endif; ?>
				    		<td><?php echo strtoupper($brand_user['abbreviation']); ?> First Name</td>
				    		<td><?php echo $fx_user_meta['first_name'][0]; ?></td>
					  </tr>

					  <tr>
					  	<?php if ($fx_user[0]->user_url == $brand_user['urlLink']): ?>
								<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
							<?php else: ?>
								<img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix">
							<?php endif; ?>
							<td><?php echo strtoupper($brand_user['abbreviation']); ?> Website URL</td>
							<td><?php echo $fx_user[0]->user_url; ?></td>
					  </tr>

					  <tr>
					  	<?php if ($fx_user_data->roles[0] == 'administrator'): ?>
							<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
						<?php endif; ?>
						<td><?php echo strtoupper($brand_user['abbreviation']); ?> Account Role</td>
						<td><?php echo $fx_user_data->roles[0]; ?></td>

					  </tr>
			<?php else: ?>
				 	<tr>
					    <td colspan="6">
					    	<p class="error-msg"><?php echo strtoupper($brand_user['abbreviation']); ?> Editor Account Doesn't Exist</p>
					    </td>
				    </tr>
			 <?php endif ?>
				</table>
			</div>
			

			<?php if ($brand_user['abbreviation'] == 'fx'): ?>
				<?php 
					$fx_editor = get_users( array( 'search' => '*fx-editor2154*' ) );
					// echo '<pre>';
					// print_r($fx_editor[0]->data);
					// echo '</pre>';
					$fx_editor_meta = get_userdata($fx_editor[0]->data->ID);
				 ?>

				 
				 	<div class="table-wrapper">
						<h2><?php echo strtoupper($brand_user['abbreviation']); ?> Editor Account</h2>
						<table class="table-title">
						  <tr>
						    <th>Status</th>
						    <th>Label</th>
						    <th>Value</th>
						    <th>Solution</th>
						  </tr>
					<?php if (!empty($fx_editor)): ?>
					  	<?php if($fx_editor[0]->data->user_login == 'fx-editor2154'): ?>
							<td><img src="<?php echo $check_icon; ?>"></td>
						<?php else: ?>
							<td><img src="<?php echo $x_cross; ?>" class="test-icon"></td>
						<?php endif; ?>
							<td><p class="test-title"><?php echo strtoupper($brand_user['abbreviation']); ?> Username</td>
						    <td><?php echo $fx_editor[0]->data->user_login; ?></td>
						    <td>Solution</td>
						  </tr>


						  <tr>
						  	<?php if ($fx_editor[0]->data->user_email == 'editor@fxwebstudio.com.au'): ?>
								<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
							<?php else: ?>
								<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
							<?php endif; ?>
					    		<td><?php echo strtoupper($brand_user['abbreviation']); ?> Email</td>
					    		<td><?php echo $fx_editor[0]->data->user_email; ?></td>
					    		<td>Solution</td>
						  </tr>

						  <tr>
							<?php if ($fx_editor[0]->data->display_name == 'fx-editor2154'): ?>
								<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
							<?php else: ?>
								<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
							<?php endif; ?>
					    		<td><?php echo strtoupper($brand_user['abbreviation']); ?> Display Name</td>
					    		<td><?php echo $fx_editor[0]->data->display_name; ?></td>
					    		<td>Solution</td>
						  </tr>

						  <tr>
						  	<?php if ($fx_editor_meta->roles[0] == 'editor'): ?>
								<td><img src="<?php echo $check_icon; ?>" class="test-icon wp-prefix"></td>
							<?php else: ?>
								<td><img src="<?php echo $x_cross; ?>" class="test-icon wp-prefix"></td>
							<?php endif; ?>
							<td><?php echo strtoupper($brand_user['abbreviation']); ?> Account Role</td>
							<td><?php echo $fx_user_data->roles[0]; ?></td>

						  </tr>
						
				 <?php else: ?>
				 	<tr>
					    <td colspan="6">
					    	<?php echo strtoupper($brand_user['abbreviation']); ?> Editor Account Doesn't Exist
					    </td>
				    </tr>
				 <?php endif ?>
						</table>
					</div>
			<?php endif ?>
			

			<div class="table-wrapper">
				<h2><?php echo strtoupper($brand_user['abbreviation']); ?> User Accounts List</h2>
				<table class="table-title">
					<tr>
					    <th>ID</th>
					    <th>Username</th>
					    <th>Display Name</th>
					    <th>Email</th>
					    <th>Website</th>
					    <th>User Role</th>
					</tr>

					<?php if (count($all_users) != 0): ?>
						<?php foreach ($all_users as $user): ?>
							<?php $user_data = get_userdata( $user->ID ); ?>
							<tr>
								<td><?php echo $user->ID ?></td>
								<td><?php echo $user->user_login ?></td>
								<td><?php echo $user->display_name ?></td>
								<td><?php echo $user->user_email ?></td>
								<td><?php echo $user->user_url ?></td>
								<td><?php echo $user_data->roles[0]; ?></td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
						    <td colspan="6">
						    	<p class="error-msg">No Accounts</p>
						    </td>
					    </tr>
					<?php endif ?>
				</table>
			</div>
			
			
	<?php return ob_get_clean();
	}
	public function get_permalink_structure(){
		global $wpdb;
		$permalink_structure = $wpdb->get_var( "SELECT option_value FROM $wpdb->options WHERE option_id = 28" );

		ob_start(); ?>
			<?php if ($permalink_structure == '/%postname%/'): ?>
				<div class="container">
					<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
				    <p class="test-title">Permalink Structure is set to : Post Name </p>
				</div>
			<?php else: ?>
				<div class="container">
					<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
				    <p class="test-title">Permalink Structure is not set to : Post Name </p>
				</div>
			<?php endif; ?>
		<?php return ob_get_clean(); ?>
	<?php }

	public function user_capabilities(){

		ob_start(); ?>
			<div class="container">
				<?php $editor_cap = get_role( 'editor' )->capabilities; ?>
				<?php $options = ['manage_options', 'edit_theme_options']; ?>
				<p>Editors Capabilities:</p>
				<?php foreach ($options as $option): ?>
					<?php if (array_key_exists($option, $editor_cap)): ?>
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
						<p class="test-title">Ticked <?php echo $option; ?></p></br>					
					<?php else: ?>
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
						<p class="test-title"><?php echo $option; ?> needs to be checked</p></br>
					<?php endif; ?>
				<?php endforeach; ?>
				</br>
				<?php $arr_roles = ['contributor', 'subscriber', 'author'] ?>

				<?php foreach ($arr_roles as $role): ?>
					<?php $capabilities = get_role( $role )->capabilities; ?>

					<?php if ($role == 'contributor' && count($capabilities) < 3): ?>
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
						<p class="test-title">Contributor Capabilities : None</p></br>

					<?php elseif($role == 'subscriber' && count($capabilities) < 2): ?>
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
						<p class="test-title">Subscriber Capabilities : None</p></br>

					<?php elseif($role == 'author' && count($capabilities) < 4): ?>
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
						<p class="test-title">Author Capabilities : None</p></br>

					<?php else: ?>
						<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
						<p class="test-title"><?php echo ucfirst($role); ?> Capabilities :</p>

						<?php 
						$index = 1;
						$filtred = [];
						
						foreach($capabilities as $key => $value){
							if(preg_match('/^level_/',$key))
							    $filtred[$key] = $value;	
							}
						foreach ($filtred as $key => $value) {
							unset($capabilities[$key]);
						}

						foreach ($capabilities as $key => $capability): ?>
						</br>
							<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon" style="width: 20px; margin-left: 30px;">
							<p class="test-title"><?php echo $index.'. '.$key; ?></p>
							<?php $index++; ?>
						<?php endforeach; ?>

					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php return ob_get_clean(); ?>
	<?php }

	public function check_domain(){

		ob_start(); ?>

		<?php if (strpos(get_bloginfo('url'), 'www' ) !== false): ?>
			<div class="container">
				<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
				<p class="test-title">Domain have www </p>
			</div>
		<?php else: ?>
			<div class="container">
				<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
				<p class="test-title">Domain doesn't have www </p>
			</div>			
		<?php endif; ?>
		<?php return ob_get_clean(); ?>
	<?php }

	public function misc_wordpress($brand){

		ob_start(); ?>
			<?php if (get_bloginfo('language') == 'en-AU'): ?>
				<div class="container">
					<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
				    <p class="test-title">Site Language is set to English (Australia) </p>
				</div>
			<?php else: ?>
				<div class="container">
					<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
				    <p class="test-title">Site Language is must be set to English (Australia) </p>
				</div>
			<?php endif; ?>
			<?php// var_dump($brand); ?>
			<?php if (get_bloginfo('admin_email') == $brand['email']): ?>
				<div class="container">
					<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
				    <p class="test-title">Wordpress Email : <?php echo get_bloginfo('admin_email') ?> </p>
				</div>
			<?php else: ?>
				<div class="container">
					<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
				    <p class="test-title">Wordpress Email : <?php echo get_bloginfo('admin_email') ?> </p>
				</div>
			<?php endif; ?>

			
			 
			<?php global $wpdb;
				$hello_page = $wpdb->get_var( "SELECT post_name FROM $wpdb->posts WHERE post_name = 'hello-world'" );
				$sample_page = $wpdb->get_var( "SELECT post_name FROM $wpdb->posts WHERE post_name = 'sample-page'" );

				$pages = array(
					array(
						'slug' => $sample_page,
						'name' => 'Sample Page'
					),array(
						'slug' => $hello_page,
						'name' => 'Hello world! Post'
					),
				);?>

			<div class="container">
				<?php foreach ($pages as $key => $page): ?>
			 		<?php if (isset($page['slug'])): ?>
			 			<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
			 			<p class="test-title"><?php echo $page['name']; ?> Needs to be Deleted</p></br>
			 		<?php else: ?>
			 			<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
			 			<p class="test-title">No Existing <?php echo $page['name']; ?></p></br>
			 		<?php endif; ?>
			 	<?php endforeach; ?>

			 	  
			 	<?php $privacy_page = $wpdb->get_var( "SELECT post_name FROM $wpdb->posts WHERE post_name = 'privacy-policy'" );
			 	if (isset($privacy_page)): ?>
			 		<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
			 		<p class="test-title"><?php echo $privacy_page ?> Page Exist</p></br>
			 	<?php else: ?>
			 		<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
			 		<p class="test-title">No Existing Privacy Policy</p></br>
			 	<?php endif; ?>
			</div>
		<?php return ob_get_clean(); ?>
	<?php }

	public function woocommerce_settings(){
		ob_start(); ?>

		<?php return ob_get_clean(); ?>

	<?php }
	

	public function check_plugin_versions(){


		$plugin_name = array(
			array(
				"name" => 'Change Table Prefix',
				'plugin_file' => 'change-table-prefix',
				'folder_name' => 'change-table-prefix'
			),array(
				"name" => 'Woocommerce',
				'plugin_file' => 'woocommerce',
				'folder_name' => 'woocommerce'
			),array(
				"name" => 'All in One WP Security',
				'plugin_file' => 'wp-security',
				'folder_name' => 'all-in-one-wp-security-and-firewall'
			),array(
				"name" => 'Yoast SEO',
				'plugin_file' => 'wp-seo',
				'folder_name' => 'wordpress-seo'
			),array(
				"name" => 'User Role Editor',
				'plugin_file' => 'user-role-editor',
				'folder_name' => 'user-role-editor'
			),array(
				"name" => 'WP Smush',
				'plugin_file' => 'wp-smush',
				'folder_name' => 'wp-smushit'
			),array(
				"name" => 'Contact Form 7',
				'plugin_file' => 'wp-contact-form-7',
				'folder_name' => 'contact-form-7'
			),array(
				"name" => 'Akismet',
				'plugin_file' => 'akismet',
				'folder_name' => 'akismet'
			),
		);
		ob_start(); ?>
		<?php $plugin_Basename = get_plugins(); ?>

		<?php 

			if ( !function_exists('plugins_api')) {
			       require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
			
			}
		 ?>
		<div class="container">
		<?php foreach ($plugin_Basename as $key => $value): ?>
			<?php $folder_name = strstr($key, '/' , true);
				$file_name =  substr($key, strrpos($key, '/') + 1);?>

				<?php  $args = array(
				    'slug' => $folder_name,
				    'fields' => array(
				        'version' => true,
				    )
				);
				$call_api = plugins_api( 'plugin_information', $args );
				$version_latest = $call_api->version; ?>

		 		<?php if ($value['Version'] == $version_latest): ?>
		 			<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon">
		 			<p class="test-title"><?php echo $value['Name']; ?> </br> Latest Version <?php echo $value['Version']; ?></p></br>
		 		<?php else: ?>
		 			<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
		 			<p class="test-title"><?php echo $value['Name']; ?> Needs to update. </p></br>
		 			<p class="test-title">Current version: <?php echo $value['Version']; ?> | </p>
		 			<p class="test-title">Latest version: <?php echo $version_latest; ?></p> </br>
		 		<?php endif; ?>
				</br>
		<?php endforeach; ?>
		</div>

		<?php return ob_get_clean(); ?>

		<pre>
			<?php //var_dump(get_plugin_data( '/akismet/akismet.php')); ?>
		</pre>	
		<?php 
		// est the arguments to get latest info from repository via API ##
		// $args = array(
		//     'slug' => 'wp-smushit',
		//     'fields' => array(
		//         'version' => true,
		//     )
		// );


		// /** Prepare our query */
		// $call_api = plugins_api( 'plugin_information', $args );


		// /** Check for Errors & Display the results */
		// if ( is_wp_error( $call_api ) ) {

		//     $api_error = $call_api->get_error_message();

		// } else {

		//     // echo $call_api; // everything ##


		//     if ( ! empty( $call_api->version ) ) {

		//         $version_latest = $call_api->version;

		//         // var_dump($call_api);
		// 		// die();
		//     }

		// }
	}

	public function contact_form(){
		global $wpdb;
		$contact_form_id = $wpdb->get_var( "SELECT id FROM $wpdb->posts WHERE post_title = 'Contact Form Page'" );
		$contact_form_content = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = $contact_form_id AND meta_key = '_mail'" );
		
		$contact_form_mail = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = $contact_form_id AND meta_key = '_messages'" );
		$cform_mailcontent = unserialize($contact_form_mail);
		$contact_form_body = unserialize($contact_form_content);
		// echo '<pre>';
		//  print_r($cform_mailcontent);
		//  echo '</pre>';
		ob_start(); ?>
			<div class="container">
			<?php $url = str_replace('www.', '', $_SERVER['HTTP_HOST']); ?>
				<div class="table-wrapper">
					<h2>Mail Settings</h2>
					<table class="table-title">
					  <tr>
					    <th>Status</th>
					    <th>Label</th>
					    <th>Value</th>
					    <th>Solution</th>
					  </tr>

					  <!-- Recipient -->
					  <tr>
					  	<td></td>
					  	<td>Recipient</td>
					  	<td><?php echo $contact_form_body['recipient'];?></td>
					  	<td></td>
					  </tr>

					  <!-- From Field -->
					<tr>
						<?php if (strpos($contact_form_body['sender'], '<no-reply@'.$url.'>' ) !== false): ?>
							<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
						<?php else: ?>
							<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
				 			<!-- <p class="test-title">Must be : <?php //esc_html( '<no-reply@'.$url.'>' ); ?>.</p> -->
						<?php endif ?>
							<td>From :</td>
				 			<td><?php echo esc_html( $contact_form_body['sender']);?></td>
			 		</tr>

			 		<tr>
						<?php if ($contact_form_body['subject'] == 'Contact Enquiry'): ?>
							<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
						<?php else: ?>
							<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
						<?php endif ?>
							<td>Subject :</td><p class="test-title">
							<td><?php echo $contact_form_body['subject'];?></td>
					</tr>

					<tr>
						<!-- Additional Headers Field -->
						<?php if (strpos($contact_form_body['additional_headers'], 'Reply To:' ) !== false): ?>
							<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
						<?php else: ?>
							<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
						<?php endif ?>

						<td>Reply-To:</td>
						<td><?php echo $contact_form_body['additional_headers'];?></td>
					</tr>
					<tr>
						<?php if ($contact_form_body['use_html'] == 1): ?>
							<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							<td>"Use HTML content type"</td>
				 			<td>checked</td>
						<?php else: ?>
							<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
				 			<td>"Use HTML content type"</td>
				 			<td>not checked</td>
						<?php endif ?>
					</tr>
					</table>
				</div>

				<div class="table-wrapper">
					<h2>Messages Settings</h2>
					<table class="table-title">
						<tr>
						    <th>Status</th>
						    <th>Label</th>
						    <th>Value</th>
						    <th>Solution</th>
						</tr>

						<tr>
							<!-- Sender's message was sent successfully -->
							<?php if (strpos( $cform_mailcontent['mail_sent_ok'], 'Thank you for your enquiry. One of our friendly team members will contact you shortly' ) !== false ): ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							<?php else: ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
							<?php endif ?>
							<td>Sender’s message was sent successfully</td>
							<td><?php echo $cform_mailcontent['mail_sent_ok']; ?></td>
						</tr>

						<tr>
							<!-- Sender's message failed to send -->
							<?php if (strpos( $cform_mailcontent['mail_sent_ng'], 'Failed to send your message. Please try later while we are addressing the issue.' ) !== false ): ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							<?php else: ?>
								<img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon">
					 			<p class="test-title"><?php echo $cform_mailcontent['mail_sent_ng']; ?></p></br>
							<?php endif ?>
							<td>Sender’s message was failed to send</td>
							<td><?php echo $cform_mailcontent['mail_sent_ng']; ?></td>
						</tr>

						<tr>
							<!-- Validation errors occurred -->
							<?php if (strpos( $cform_mailcontent['validation_error'], 'Error: Please fill in the required fields and resubmit.' ) !== false ): ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							<?php else: ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
							<?php endif ?>
							<td>Validation errors occurred</td>
							<td><?php echo $cform_mailcontent['validation_error']; ?></td>
						</tr>

						<tr>
							<!-- There is a field that the sender must fill in -->
							<?php if (strpos( $cform_mailcontent['invalid_required'], 'This field is required. Please enter a value.' ) !== false ): ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							<?php else: ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
							<?php endif ?>
							<td>There is a field that the sender must fill in here is a field that the sender must fill in</td>
							<td><?php echo $cform_mailcontent['invalid_required']; ?></td>
						</tr>

						<tr>
							<!-- The code that sender entered does not match the CAPTCHA -->
							<?php if (strpos( $cform_mailcontent['captcha_not_match'], 'Please enter the correct code.' ) !== false ): ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							<?php else: ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
							<?php endif ?>
							<td>The code that sender entered does not match the CAPTCHA</td>
							<td><?php echo $cform_mailcontent['captcha_not_match']; ?></td>
						</tr>

						<tr>
							<!-- Email address that the sender entered is invalid -->
							<?php if (strpos( $cform_mailcontent['invalid_email'], 'Invalid email address.' ) !== false ): ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							<?php else: ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
							<?php endif ?>
							<td>Email address that the sender entered is invalid</td>
							<td><?php echo $cform_mailcontent['invalid_email']; ?></td>
						</tr>
					</table>
				</div>

				
			</div>
		<?php return ob_get_clean(); ?>
	<?php }

	public function wordpress_settings($brand, $server){

		 global $wpdb;
		ob_start(); ?>

		<div class="table-wrapper">
			<h2>Wordpress Settings</h2>
			<table class="table-title">
				<tr>
				    <th>Status</th>
				    <th>Label</th>
				    <th>Value</th>
				    <th>Solution</th>
				</tr>
				<tr>
					<?php if (get_bloginfo('language') == 'en-AU'): ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
						<td>Site Language</td>
						<td>English (Australia)</td>
					<?php else: ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
						<td>Site Language</td>
						<td>Not English (Australia)</td>
					<?php endif; ?>
				</tr>

				<tr>
					<?php if (get_bloginfo('admin_email') == $brand['email']): ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
					<?php else: ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
					<?php endif; ?>
					<td>Wordpress Email</td>
					<td><?php echo get_bloginfo('admin_email') ?></td>
				</tr>

			 	<tr>
			 		<?php if (strpos(get_bloginfo('url'), 'www' ) !== false): ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
						<td><?php bloginfo('url') ?></td>
						<td><p class="test-title">"www" Found on "<?php bloginfo('url') ?>"</p>
					<?php else: ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
						<td><?php bloginfo('url') ?></td>
						<td>"www" Not Found on "<?php bloginfo('url') ?>"</td>
					<?php endif; ?>
			 	</tr>

			 	<tr>
			 		
			 		<?php $permalink_structure = $wpdb->get_var( "SELECT option_value FROM $wpdb->options WHERE option_id = 28" ); 

			 		$value = str_replace('%', '', $permalink_structure);
			 		$value = str_replace('/', '', $value);?>

					<?php if ($permalink_structure == '/%postname%/'): ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
					<?php else: ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
					<?php endif; ?>
					<td>Permalink Structure</td>
					<td><?php echo ucfirst($value); ?></td>
			 	</tr>

			 	<?php $prefix = $wpdb->prefix;?>

				<tr>
					<?php if ($prefix == $brand['abbreviation'].'wp_'): ?>
			    		<td><img src="<?php echo  plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>

					<?php else: ?>
			    		<td><img src="<?php echo  plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon wp-prefix"></td>
					<?php endif; ?>
					<td>WP Table Prefix</td>
			    	<td><?php echo $prefix; ?></td>
				</tr>

				<tr>
			 		<?php $url = 'https://api.wordpress.org/core/version-check/1.7/';
					$response = wp_remote_get($url);

					$json = $response['body'];
					$obj = json_decode($json);
					$upgrade = $obj->offers[0]; ?>
		
					<?php if (get_bloginfo('version') == $upgrade->version): ?>
						<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
					    <td>Wordpress Version</td>
					    <td><?php bloginfo('version'); ?></td>
					<?php else: ?>
					    <td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
					    <td>Wordpress Version</td>
					    <td><?php bloginfo('version'); ?> </br> Latest Version : <?php echo $upgrade->version; ?></td>
					<?php endif ?>
				</tr>

				<tr>
					<?php $search_engine_opt = $wpdb->get_var( "SELECT option_value FROM $wpdb->options WHERE option_id = 51" ); ?>
					
					<?php if ($server == 'preview'): ?>
						<?php if ($search_engine_opt == 0): ?>
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							    <td>Search Engine Visibility</td>
							    <td>Disabled</td>
						<?php else: ?>
							<div class="container">
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
							    <td>Search Engine Visibility</td>
							    <td>Enabled</td>
							</div>
						<?php endif; ?>
					<?php else: ?>
						<?php if ($search_engine_opt == 1): ?>
							<div class="container">
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
							    <td>Search Engine Visibility</td>
							    <td>Enabled</td>
							</div>
						<?php else: ?>
							<div class="container">
								<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
							    <td>Search Engine Visibility</td>
							    <td>Disabled</td>
							</div>
						<?php endif; ?>
					<?php endif ?>
				</tr>
			</table>
		</div>


		<div class="table-wrapper">
			<h2>Wordpress Pages and Posts</h2>
			<table class="table-title">
				<tr>
				    <th>Status</th>
				    <th>Label</th>
				    <th>Value</th>
				    <th>Solution</th>
				</tr>

				<?php
				$hello_page = $wpdb->get_var( "SELECT post_name FROM $wpdb->posts WHERE post_name = 'hello-world'" );
				$sample_page = $wpdb->get_var( "SELECT post_name FROM $wpdb->posts WHERE post_name = 'sample-page'" );

				$pages = array(
					array(
						'slug' => $sample_page,
						'name' => 'Sample Page'
					),array(
						'slug' => $hello_page,
						'name' => 'Hello world! Post'
					),
				);?>

				<?php foreach ($pages as $key => $page): ?>
					<tr>
			 		<?php if (isset($page['slug'])): ?>
			 			<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
			 			<td><?php echo $page['name']; ?></td>
			 			<td>Exists</td>
			 		<?php else: ?>
			 			<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
			 			<td><?php echo $page['name']; ?></td>
			 			<td>Not Exist</td>
			 		<?php endif; ?>
			 		</tr>
			 	<?php endforeach; ?>

			 	<tr>
			 		<?php $privacy_page = $wpdb->get_var( "SELECT post_name FROM $wpdb->posts WHERE post_name = 'privacy-policy'" );
				 	if (isset($privacy_page)): ?>
				 		<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/check.png' ?>" class="test-icon"></td>
				 		<td><?php echo $privacy_page ?></td>
				 		<td>Page Exist</td>
				 	<?php else: ?>
				 		<td><img src="<?php echo plugins_url().'/fxbp-scanner/public/images/x.png' ?>" class="test-icon"></td>
				 		<td>Privacy Policy</td>
				 		<td>Page Not Exist</td>
				 	<?php endif; ?>
			 	</tr>
			</table>
		</div>

		<?php return ob_get_clean(); ?>
	<?php }
}