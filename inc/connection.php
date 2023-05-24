<?php
ini_set('display_errors', 'On');
	try {
		// ================ PostgreSQL ================
		// $db_main = new PDO("mysql:host=localhost;dbname=main_db", 'root');
		// $db = new PDO("mysql:host=localhost;dbname=media", 'root');
		// ================ PostgreSQL ================
		$db_main = new PDO("pgsql:host=localhost;port=5432;dbname=main_db" ,"postgres", "0123");
		$db = new PDO("pgsql:host=localhost;port=5432;dbname=media" ,"postgres", "0123");
		$db_main->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "Error : ".$e->getMessage();
	}
	@session_start();
    ?>