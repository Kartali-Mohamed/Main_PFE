<?php
	ini_set('display_errors', 'On');
	try {
		// ================ MySql ================
		// $db = new PDO("mysql:host=localhost;dbname=media", 'root');
		// ================ PostgreSQL ================
		// user = "postgres" , password = "0123" (option)
		$db = new PDO("pgsql:host=localhost;port=5432;dbname=media" ,"postgres", "0123");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "Error : ".$e->getMessage();
	}
	@session_start();
?>