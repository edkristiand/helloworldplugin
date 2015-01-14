<?php
/*BRANCH TEST
Plugin Name: Platypus Productions
Plugin URI: http://edxtian.site11.com
Description: Basic Hello World Plugin
Author: Edkristian Daguit
Version: 1.0
Author URI: http://edxtian.site11.com
*/
	session_start();
	add_action('admin_menu','my_menu');

	function my_menu(){
		add_menu_page('Hello World Plugin', 'Platypus Productions', 'manage_options', __FILE__, 'hello_world_main');
		add_submenu_page( __FILE__, 'Hi', 'Hi', 'manage_options', 'hi_submenu', 'hi_submenu');
	}
	
	function hello_world_main(){
		$myentry = $_SESSION['result'];
    	print "<h1>Hello $myentry !</h1>";
	}
	
	function hi_submenu() {
		print '<div class = "wrap">';
		print '<h3>Welcome to Hi Window!</h3>';
		print '</div>';
		print '<form action = "" method = "POST">';
		print '<input type="text" name="firstname" placeholder="First Name" size="28"><br>';
		print '<input type="text" name="lastname" placeholder="Last Name" size="28"><br>';
		print '<input type = "submit" name = "add_data" value ="Add Data">';
		print '<input type = "submit" name = "display_data" value ="Display JSON Output"/>';
		print '</form>';
		print '<h4>JSON Output:</h4>';

		global $wpdb;
		if(isset($_POST['add_data'])) {
			$wpdb->insert("wp_options", array(
				"option_name" => $_POST['firstname'],
				"option_value" => $_POST['lastname']
				)
			);
			print '<script language="javascript">';
			print 'alert("Data Sucessfully Added!")';
			print '</script>';
		}
		
		if(isset($_POST['display_data'])) {
			$result = $wpdb->get_results (
				"
				SELECT * FROM wp_options
				WHERE option_id = '178'
				"
				, ARRAY_N
			);
			$_SESSION['result'] = $result[0][1];
		}
?>
		<textarea rows="12" cols="35" ><?php print_r($result); ?></textarea>
<?php	
	}
?>