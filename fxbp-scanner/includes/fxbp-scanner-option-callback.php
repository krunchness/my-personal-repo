<?php 

add_action('wp_ajax_my_action', 'scan_function_callback');

function scan_function_callback() {

	$scan = new Scanner();

	switch ($_POST['opt']) {
		case 'wp-prefix':
			// echo "<pre>";
			// var_dump($_POST['BPOptions']);
			// echo "</pre>";
			echo $scan->get_wp_prefix($_POST['BPOptions']['brandType']);
			break;
		case 'fx_user':
			echo $scan->check_fx_user($_POST['BPOptions']['brandType']);
			break;
		case 'changelog':
			echo $scan->check_files();
			break;
		case 'active_plugins':
			echo $scan->check_plugins_test($_POST['BPOptions']['websiteType']);
			break;

		case 'deactivated_plugins':
			echo $scan->deactivated_plugins();
			break;

		case 'check_wp_ver':
			echo $scan->check_wordpress_version();
			break;
		case 'get_seo':
			echo $scan->get_search_engine($_POST['BPOptions']['serverType']);
			break;
		case 'get_permalink':
			echo $scan->get_permalink_structure();
			break;
		case 'check_domain':
			echo $scan->check_domain();
			break;
		case 'misc_wordpress':
			echo $scan->misc_wordpress($_POST['BPOptions']['brandType']);
			break;
		case 'user_capabilities':
			echo $scan->user_capabilities();
			break;
		case 'plugin_version':
			echo $scan->check_plugin_versions();
			break;
		case 'contact_form':
			echo $scan->contact_form();
			break;

		case 'wordpress_settings':
			echo $scan->wordpress_settings($_POST['BPOptions']['brandType'], $_POST['BPOptions']['serverType']);
			break;
		default:
			die();
			break;
	}
     exit();
}