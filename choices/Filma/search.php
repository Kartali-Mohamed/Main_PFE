<?php
require('inc/connection.php');
require('inc/function.php');

if(!isset($_GET['s']) || empty($_GET['s']) ){
	header('Location: index.php');
	die();
}

$search = trim(filter_input(INPUT_GET,"s",FILTER_DEFAULT));

try{
	$url = 'http://127.0.0.1:8000/search?text='.urlencode($search);
	$r = curl_init($url);
	curl_setopt($r, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($r);
	curl_close($r);

	$arr = json_decode($response);
	$search_list = implode(",", $arr);

    // ================ MySql ================
	// $q = $db->prepare('SELECT videos.id as vid,title,description,id_owner,thumbnail_loca,date,users.id,username,fullname FROM videos JOIN users WHERE videos.id_owner=users.id AND videos.id IN ('.$search_list.') ORDER BY FIND_IN_SET(videos.id, "'.$search_list.'")');
    // ================ PostgreSQL ================
	$q = $db->prepare("SELECT videos.id as vid, title, description, id_owner, thumbnail_loca, date, users.id, username, fullname FROM videos JOIN users ON videos.id_owner=users.id WHERE videos.id IN (SELECT unnest(ARRAY[$search_list])) ORDER BY POSITION(videos.id::text in '$search_list')");
	$q->execute();
	$searchResult = $q->fetchALL(PDO::FETCH_ASSOC);
}catch(Exception $e){
	$error_message[] = "Error : ".$e->getMessage();
}
require('views/search.php');
?>
