<?php
require('inc/connection.php');
require('inc/function.php');
require('inc/video.php');

if(empty($_GET['id'])|| !is_numeric($_GET['id']) ){
	redirect_to('404');
}

$id = $_GET['id'];

$video = new Video();
//Check if video id exist first
$video = $video->getVideoData($id);
// print_r($video);

if($_SERVER["REQUEST_METHOD"] != "POST"){
	//if the query result is empty or not setted redirect
	if(empty($video))
		redirect_to('404');
}

//retrieve the uploader data
$uploader = new Video();
$uploader = $uploader->getUploaderData($id);

$fullname = ucfirst($uploader['fullname']);
$username = $uploader['username'];
$title = ucfirst($video['title']);
$description = $video['description'];
$locavideo = $video['vid_loca'];
$locathumbnail = $video['thumbnail_loca'];
$date = $video['date'];

$vid = new Video();
$like = getVoteCount($id, 1);
$dislike = getVoteCount($id, 0);
$comments = $vid->getAllComment($id);


if($_SERVER["REQUEST_METHOD"] == "POST"){
	// loader("Wait a Sec");
	if(isset($_POST['comment'])){
		set_error_msg("Loading..");
		//Filtering input
		$comment = trim(filter_input(INPUT_POST,"comment",FILTER_SANITIZE_SPECIAL_CHARS));
		//date of the video
		$vid->addComment($comment, $id, get_session('id'), date("M d, Y",time()));

	}
	if(isset($_POST['Cdel'])){
		set_error_msg("Loading..");
		$vid->deleteComment($_POST['id']);
	}
	if(isset($_POST['Vdel'])){
		set_error_msg("Loading..");
		$delvideo = new Video();
		$delvideo->deleteVideo($_POST['id']);
		$delvideo->deleteAllCommentOfVideo($_POST['id']);
		$delvideo->deleteAllVoteOfVideo($_POST['id']);
		$delvideo->deleteEmbeddingOfVideo($_POST['id']);
		//delete Video & Thumbnail src
		$vid->deleteThumbnail_video($locavideo, $locathumbnail);
	}
	header('refresh:3;url=video.php?id='.$id.'&op=done');
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$ip = ip2long($ip);
@$usr_id = get_session('id');
require('views/video.php');
?>
