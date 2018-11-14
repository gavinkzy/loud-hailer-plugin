<?php
/**
*Plugin Name: The Loud Hailer Plugin
* Plugin URI:        https://github.com/gavinkzy/wordpressplugin.git
*Description: This is an announcement plugin. With tools.
 * Version:           1.0.0
 * Author:            Gavin
 * Author URI:        Author URI
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-announce
 * Domain Path:       /languages
**/
	function announce_function(){
	//shortcode to display first announcement
		include('/main/announcement.html');
	}
	add_shortcode('announcement','announce_function');
	
	function announcement_admin_menu_option(){
		$myicon = 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDI5NyAyOTciIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDI5NyAyOTciIHdpZHRoPSIzMnB4IiBoZWlnaHQ9IjMycHgiPgogIDxnPgogICAgPHBhdGggZD0ibTI0MC41MDcsMTAyLjg1OGMyNy41NiwwIDQ5Ljk4Mi0yMi40MjIgNDkuOTgyLTQ5Ljk4MnMtMjIuNDIyLTQ5Ljk4MS00OS45ODItNDkuOTgxLTQ5Ljk4MSwyMi40MjEtNDkuOTgxLDQ5Ljk4MSAyMi40MjEsNDkuOTgyIDQ5Ljk4MSw0OS45ODJ6IiBmaWxsPSIjMDAwMDAwIi8+CiAgICA8cGF0aCBkPSJNMTkwLjUyNiwxNjV2MTI0LjU3MmMwLDQuMTAyLDMuMzI2LDcuNDI4LDcuNDI4LDcuNDI4aDgwLjA5MmM0LjEwMiwwLDcuNDI4LTMuMzI2LDcuNDI4LTcuNDI4VjE2NSAgIGMwLTI2LjIxOS0yMS4yNTUtNDcuNDc0LTQ3LjQ3NC00Ny40NzRoMEMyMTEuNzgxLDExNy41MjYsMTkwLjUyNiwxMzguNzgxLDE5MC41MjYsMTY1eiIgZmlsbD0iIzAwMDAwMCIvPgogICAgPHBhdGggZD0ibTE0Ny45MzksMzcuNjg4bC0xMzAuNzY0LTM3LjM2MWMtMC43NjktMC4yMTktMS41NDktMC4zMjctMi4zMjItMC4zMjctMS43ODksMC0zLjUzOCwwLjU3OC01LjAxNCwxLjY5Mi0yLjExNSwxLjU5Ni0zLjMyNyw0LjAzLTMuMzI3LDYuNjc5djk3LjI4MmMwLDIuNjQ5IDEuMjEyLDUuMDgzIDMuMzI3LDYuNjc5IDIuMTE0LDEuNTk1IDQuNzg3LDIuMDkxIDcuMzM3LDEuMzY1bDEzMC43NjQtMzcuMzYxYzMuNTcyLTEuMDIxIDYuMDY2LTQuMzI4IDYuMDY2LTguMDQzdi0yMi41NjJjMC0zLjcxNS0yLjQ5NS03LjAyMi02LjA2Ny04LjA0M3oiIGZpbGw9IiMwMDAwMDAiLz4KICAgIDxwYXRoIGQ9Im0xMjAuNDU3LDEwOS45NDVsLTMzLjMxOSwxMC42MDJ2LTExLjM5bC0xOC4wMzksNS4xNTR2MTguNTcxYzAsMi44NzggMS4zNzMsNS41ODIgMy42OTUsNy4yODEgMS41NjUsMS4xNDQgMy40MzQsMS43MzkgNS4zMjUsMS43MzkgMC45MTYsMCAxLjgzOC0wLjE0IDIuNzM0LTAuNDI1bDUxLjM1OC0xNi4zNDJjMy43NDMtMS4xOTEgNi4yODUtNC42NjcgNi4yODUtOC41OTV2LTIyLjA1N2wtMTguMDM5LDUuMTU0djEwLjMwOHoiIGZpbGw9IiMwMDAwMDAiLz4KICA8L2c+Cjwvc3ZnPgo=';
		add_menu_page('The Loud Hailer','Loud Hailer','manage_options','announcement-admin-menu','announcement_scripts_page','data:image/svg+xml;base64,' . $myicon,150);
	}
	add_action('admin_menu','announcement_admin_menu_option');
	
	//admin page
	function announcement_scripts_page()
	{
		if(array_key_exists('submit_scripts_update',$_POST)){
				# Make connection to database
				$conn = mysqli_connect("localhost","root",'');
				if(!$conn){
					die("connection error".mysql_error());
				}
				//check if database exists
				$db=mysqli_select_db($conn,"pluginannouncement");
				// create database/tables if does not exist
				if(empty($db))
				{
					//db creation
					$dbcr="CREATE DATABASE pluginannouncement"; 
					$check=mysqli_query($conn,$dbcr);
					if(!$check)
						echo "Database create error";
					else
						echo "This is your first announcement. Database has been created successfully.";
					//table creation
						mysqli_select_db($conn,"pluginannouncement" );
						$queryCreateUsersTable = "CREATE TABLE announcements( ".
						"id INT NOT NULL AUTO_INCREMENT, ".
						"title VARCHAR(100) NOT NULL, ".
						"contents VARCHAR(32765) NOT NULL, ".
						"PRIMARY KEY ( id )); ";
						$check2=mysqli_query($conn,$queryCreateUsersTable);
						if(!$check2)
							echo " Tables creation error";
						else
							echo " Tables created successfully";
					
}
				//'cache' save in field
				update_option('announcement_header_scripts',$_POST['header_scripts']);
				update_option('announcement_footer_scripts',$_POST['footer_scripts']);
				//insert content into db 
				global $wpdb;
				$mydb = new $wpdb('root','','pluginannouncement','localhost');
				$title = $_POST['header_scripts'];
				$contents = $_POST['footer_scripts'];
				$table_name = "announcements";
				$mydb->insert($table_name, array('title' => $title, 'contents' => $contents) ); 
			?>
			<div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Input successful.</strong></div>
			<?php
		}
		
		$header_scripts = get_option('announcement_header_scripts','none');
		$footer_scripts = get_option('announcement_footer_scripts','none');
		
		// Form
		include("/main/form.html"); 
		
		//Data fetch
		include("/tools/viewbutton.html");
	}
?>
