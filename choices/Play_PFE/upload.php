<?php
require('inc/connection.php');
require('inc/function.php');
require('inc/video.php');

if(isset($_GET['status'])){
	$header = "successed";
	require('inc/header.php');
	if($_GET['status']=='uploaded'){
		echo '<br><br><br><br>';
		echo '<h1><center> *_* </h1>';
		echo '<p><center>Votre demande est envoyée avec Succès.</p>';
		die();
	}
}

//if not Loggedin redirect to the main page
if(!loggedin())
	redirect_to('login');


if($_SERVER["REQUEST_METHOD"] == "POST"){

	//Filtering input
	$title = trim(filter_input(INPUT_POST,"title",FILTER_DEFAULT));
	$description = trim(filter_input(INPUT_POST,"description",FILTER_SANITIZE_SPECIAL_CHARS));
	$video_id;

	//Files to be uploaded
	$vid_tmp_name = $_FILES['video']['tmp_name'];
	$thumbn_tmp_name = $_FILES['thumbnail']['tmp_name'];

	//Check if empty (required fields)
	if(empty($title) || empty($description)){
			set_error_msg("Veuillez remplir les champs obligatoires : Titre et Description");
			redirect_to('upload');
	}
	if(empty($vid_tmp_name)|| empty($thumbn_tmp_name)){
		    set_error_msg("Veuillez remplir les champs obligatoires : Vidéo et Vignette.");
			redirect_to('upload');
	}
	if(strlen($title) > 100){
		set_error_msg("HEY, Titre de la vidéo doit comporter moins de 100 caractères.");
		redirect_to('upload');
	}
	if(strlen($description) > 32500){
		set_error_msg("HEY, Description de la vidéo doit comporter moins de 32500 caractères.");
		redirect_to('upload');
	}

	//name of the video & thumbnail
	$name = get_session('id').'-'.date_timestamp_get(date_create());

	create_dir('./media/video/');
	create_dir('./media/thumbnail/');

	try{

		$video_name = $_FILES['video']['type'];
		$videos_ext = str_split($video_name, strpos($video_name, '/')+1)[1];
		$thumbnail_name = $_FILES['thumbnail']['type'];
		$thumbnail_ext = str_split($thumbnail_name, strpos($thumbnail_name, '/')+1)[1];

		//Full direction of both video & thumbnail
		$vid_uploads_dir = './media/video/'.$name .'.'.$videos_ext;
		$thumbn_uploads_dir = './media/thumbnail/'.$name. '.'. $thumbnail_ext;

		//Start uploading
		// set_error_msg("Loading...");
		set_error_msg("Loading..");
		$upload_video = move_uploaded_file($vid_tmp_name, $vid_uploads_dir);
		$upload_thumbn = move_uploaded_file($thumbn_tmp_name, $thumbn_uploads_dir);

		if($upload_video && $upload_thumbn) {
			$video = new Video();
			$video->setInfo($title, $description, get_session('id'), $vid_uploads_dir, $thumbn_uploads_dir, date("M d, Y",time()));
			$video->add();
			$video_id = $video->getVideoId();
		}

	}catch(Exception $e){
		$error_message[] = "Error : ".$e->getMessage();
	}

	if(is_file($vid_uploads_dir) && is_file($thumbn_uploads_dir) ){
		// Check if video upload in database success
		if(isset($video_id)){
			//if the uploaded do exist then
            // Get and save embedding of title and description 
			$url = 'http://127.0.0.1:8000/embedding/text?id='.$video_id['id'].'&title='.urlencode($title).'&desc='.urlencode($description);
			$r = curl_init($url);
			curl_setopt($r, CURLOPT_POST, true);
			curl_setopt($r, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($r);
			curl_close($r);
			//Redirect to this page
			header('refresh:1;url=upload.php?status=uploaded');
			//header('Location: upload.php?status=uploaded');
		} else {
			//Delete Video & Thumbnail src
			$video = new Video();
			$video->deleteThumbnail_video($vid_uploads_dir, $thumbn_uploads_dir);
			unset_session("error");
			set_error_msg("Échec -_- Essayer à nouveau");
			redirect_to('upload');
		}
		
	}else{
		set_error_msg("Erreur s'est produite, Veuillez réessayer !!");
		redirect_to('upload');
	}
}
load_view('upload');
?>
