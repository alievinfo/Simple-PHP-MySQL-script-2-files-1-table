<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$database_host = "127.0.0.1";
	$database_user = "root";
	$database_password = "";
	$database_name = "db_name";
	
/**
 * Filter text
 * @author Rashad Aliyev (rashad@aliev.info)
 * @param $text
 */
function mCMSRequestFilter($text)
{
	if (!is_array($text)) {
		if (strlen($text) > 0) {
			$text = strip_tags($text);
			$text = stripslashes($text);
			$text = addslashes($text);
			$text = trim($text);
			$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
			$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
			$text = str_replace($search, $replace, $text);
			return $text;
		} else {
			return '';
		}
	} else {
		return '';
	}
}


$form_name = array_key_exists('form_name', $_POST) ? mCMSRequestFilter($_POST['form_name']) : "";
$form_email = array_key_exists('form_email', $_POST) ? mCMSRequestFilter($_POST['form_email']) : "";

if ( (strlen($form_name)>1) && (strlen($form_email)>5) && (filter_var($form_email, FILTER_VALIDATE_EMAIL)) )
{
	$c_link = mysqli_connect($database_host, $database_user, $database_password, $database_name);
	if (!$c_link) {
		die('Could not connect: ' . mysqli_error($c_link));
	}
	
	$check_sql = "SELECT * FROM `m_simple_script` WHERE `email` = '".$form_email."'";
	$check_query = mysqli_query($c_link, $check_sql);
	if ($check_row = mysqli_fetch_assoc($check_query)) {
		echo "This email address is already taken! The ID is: " . $check_row['id'];
	} else {
		$insert_sql = "INSERT INTO `m_simple_script`(`id`, `name`, `email`)
			VALUES(NULL, '".$form_name."', '".$form_email."')
		";
		if (mysqli_query($c_link, $insert_sql)) {
			echo "Success! Your ID is: ".mysqli_insert_id($c_link);
		} else {
			echo "Error";
		}
	}
} else {
	if (strlen($form_name)<=1) echo "You haven't entered your name<br/>";
	if (strlen($form_email)<=5) echo "You haven't entered your email address<br/>";
	if (!filter_var($form_email, FILTER_VALIDATE_EMAIL)) echo "Please check your email address<br/>";
}


} else {
	echo "You haven't entered data";
}