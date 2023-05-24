<?php
/**
 *
 */
 include('connection.php');


class Video
{

  public $id;
  public $title;
  public $description;
  public $id_owner;
  public $vid_loca;
  public $thumbnail_loca;
  public $date;

  function __construct()
  {
    // code...
  }

  function setInfo($title, $description, $id_owner, $vid_loca, $thumbnail_loca, $date)
  {
    $this->title = $title;
    $this->description = $description;
    $this->id_owner = $id_owner;
    $this->vid_loca = $vid_loca;
    $this->thumbnail_loca = $thumbnail_loca;
    $this->date = $date;
    return $this;
  }

  function getInfo($id){
    global $db;
  	//Check if video id exist first
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT * FROM `videos` WHERE id = ?");
  		// $q->bindParam(1, $id);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT * FROM videos WHERE id = '$id'");
  		$q->execute();
  		$result = $q->fetchAll(PDO::FETCH_ASSOC);
      $this->infoSetter($result);
  		return $this;
  	}catch(Exception $e){
  		return $e->getMessage();
  	}
  }

   function infoSetter($result){
    extract($result);
    $this->setInfo($title, $description, $id_owner, $vid_loca, $thumbnail_loca, $date);
  }

  function add(){
    global $db;
  	//Add video metadata to the DB
  	//INSERT INTO `videos`(`title`, `description`, `id_owner`, `vid_loca`, `thumbnail_loca`, `date`)
  	//VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
	// ================ MySql ================
  	// $q = $db->prepare("INSERT INTO `videos` (`title`, `description`, `id_owner`, `vid_loca`, `thumbnail_loca`, `date`) VALUES ( ?, ?, ?, ?, ? ,? )");
  	// $q->bindParam(1, $this->title);
  	// $q->bindParam(2, $this->description);
  	// $q->bindParam(3, $this->id_owner);
  	// $q->bindParam(4, $this->vid_loca);
  	// $q->bindParam(5, $this->thumbnail_loca);
  	// $q->bindParam(6, $this->date);
	// ================ PostgreSQL ================
	$q = $db->prepare("INSERT INTO videos (title, description, id_owner, vid_loca, thumbnail_loca, date) VALUES ('$this->title', '$this->description', '$this->id_owner', '$this->vid_loca', '$this->thumbnail_loca', '$this->date')");
  	$q->execute();
  }

  function getVideoId(){
	global $db;
	// ================ MySql ================
	// $q = $db->prepare("SELECT MAX(`id`) as 'id' FROM `videos`");
	// ================ PostgreSQL ================
	$q = $db->prepare("SELECT MAX(id) as id FROM videos");
	$q->execute();
	$result = $q->fetch(PDO::FETCH_ASSOC);
  	return $result;
  }

  function getVideoData($id){
  	global $db;
  	//Check if video id exist first
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT * FROM `videos` WHERE `id` = ?");
  		// $q->bindParam(1, $id);
		// ================ PostgreSQL ================
  		$q = $db->prepare("SELECT * FROM videos WHERE id = '$id'");
  		$q->execute();
  		$result = $q->fetch(PDO::FETCH_ASSOC);
  		return $result;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function getUserVideo($id_owner){
  	global $db;
  	//retrieve the profile video data
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT videos.id AS vid,title,description,id_owner,vid_loca,thumbnail_loca,date,username,fullname FROM `videos` JOIN `users` on users.id = videos.id_owner where users.id = ? ORDER BY videos.id DESC");
  		// $q->bindParam(1, $id_owner);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT videos.id AS vid,title,description,id_owner,vid_loca,thumbnail_loca,date,username,fullname FROM videos JOIN users on users.id = videos.id_owner where users.id = '$id_owner' ORDER BY videos.id DESC");
  		$q->execute();
  		$result = $q->fetch(PDO::FETCH_ASSOC);
  		return $result;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function getAllUserVideo($id_owner){
	global $db;
	//retrieve the profile video data
	try{
		// ================ MySql ================
		// $q = $db->prepare("SELECT videos.id AS vid,title,description,id_owner,vid_loca,thumbnail_loca,date,username,fullname FROM `videos` JOIN `users` on users.id = videos.id_owner where users.id = ? ORDER BY videos.id DESC");
		// $q->bindParam(1, $id_owner);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT videos.id AS vid,title,description,id_owner,vid_loca,thumbnail_loca,date,username,fullname FROM videos JOIN users on users.id = videos.id_owner where users.id = '$id_owner' ORDER BY videos.id DESC");
		$q->execute();
		$result = $q->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}catch(Exception $e){
		$error_message[] = "Error : ".$e->getMessage();
	}
}

  function getUploaderData($id){
  	global $db;
  	//retrieve the uploader data
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT videos.id_owner vid,users.id,username,fullname FROM `videos` JOIN `users` WHERE videos.id_owner=users.id AND videos.id = ?");
  		// $q->bindParam(1, $id);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT videos.id_owner vid,users.id,username,fullname FROM videos JOIN users ON videos.id_owner=users.id AND videos.id = '$id'");
  		$q->execute();
  		$result = $q->fetch(PDO::FETCH_ASSOC);
  		return $result;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function getAllComment($id){
  	global $db;
  	//retrieve the limited Requests Data
  	try{
  		//SELECT requests.id,title,description,vid_loca,thumbnail_loca,date,COUNT(requests.id),username FROM requests JOIN users where requests.id_owner = users.id
  		// ================ MySql ================
		// $q = $db->prepare("SELECT comments.id,content,date,id_owner,id_video,username,fullname FROM comments JOIN users where id_owner=users.id AND id_video = ? ORDER by comments.id");
  		// $q->bindParam(1, $id);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT comments.id,content,date,id_owner,id_video,username,fullname FROM comments JOIN users on id_owner=users.id AND id_video = '$id' ORDER by comments.id");
  		$q->execute();
  		$result = $q->fetchAll(PDO::FETCH_ASSOC);
  		return $result;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }


  function deleteThumbnail_video($locavideo, $locathumbnail){
  	unlink($locavideo);
  	unlink($locathumbnail);
  }

  function deleteThumbnail_videoAdmin($loca){
  	unlink(realpath('../media/thumbnail/'.$loca.'.jpg'));
  	unlink(realpath('../media/video/'.$loca.'.mp4'));
  }

  function deleteVideo($id){
  	global $db;
  	//DELETE FROM `videos` WHERE `id`
	// ================ MySql ================
  	// $q = $db->prepare("DELETE FROM `videos` WHERE `id`= ?");
  	// $q->bindParam(1, $id);
	// ================ PostgreSQL ================
	$q = $db->prepare("DELETE FROM videos WHERE id='$id'");
  	$q->execute();
  }

  function deleteAllCommentOfVideo($id){
  	global $db;
  	//DELETE FROM `comments` WHERE `id_video`
	// ================ MySql ================
  	// $q = $db->prepare("DELETE FROM `comments` WHERE `id_video`= ?");
  	// $q->bindParam(1, $id);
	// ================ PostgreSQL ================
	$q = $db->prepare("DELETE FROM comments WHERE id_video='$id'");
  	$q->execute();
  }

  function deleteAllVoteOfVideo($id){
	global $db;
	//DELETE FROM `votes` WHERE `id_vid`
  // ================ MySql ================
	// $q = $db->prepare("DELETE FROM `votes` WHERE `id_vid`= ?");
	// $q->bindParam(1, $id);
  // ================ PostgreSQL ================
  $q = $db->prepare("DELETE FROM votes WHERE id_vid='$id'");
	$q->execute();
}

  function deleteEmbeddingOfVideo($id){
	global $db;
	//DELETE FROM `comments` WHERE `id_video`
	// ================ MySql ================
	// $q = $db->prepare("DELETE FROM `embedding` WHERE `video_id`= ?");
	// $q->bindParam(1, $id);
	// ================ PostgreSQL ================
	$q = $db->prepare("DELETE FROM embedding WHERE video_id='$id'");
	$q->execute();
}

  function getAllCount(){
  	global $db;
  	//to get someone's videos count
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT COUNT(id) FROM `videos`");
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT COUNT(id) FROM videos");
  		$q->execute();
  		$numVideos = $q->fetch(PDO::FETCH_ASSOC);
		// ================ MySql ================
  		// $numVideos = $numVideos['COUNT(id)'];
		// ================ PostgreSQL ================
  		$numVideos = $numVideos['count'];
  		return $numVideos;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function addComment($content, $id_video, $id_owner, $date){
    global $db;
    try{
      //INSERT INTO `comments`(`content`, `id_video`, `id_owner`, `date`) VALUES ([value-1],[value-2],[value-3],[value-4])
	  // ================ MySql ================
    //   $q = $db->prepare("INSERT INTO `comments` (`content`, `id_video`, `id_owner`, `date`) VALUES ( ? , ? , ? , ?)");
    //   $q->bindParam(1, $content);
    //   $q->bindParam(2, $id_video);
    //   $q->bindParam(3, $id_owner);
    //   $q->bindParam(4, $date);
	  // ================ PostgreSQL ================
	  $q = $db->prepare("INSERT INTO comments (content, id_video, id_owner, date) VALUES ('$content', '$id_video', '$id_owner', '$date')");
      $q->execute();
    }catch(Exception $e){
      $error_message[] = "Error : ".$e->getMessage();
    }
  }

  function deleteComment($id){
  	global $db;
  	try{
  		//DELETE FROM comments WHERE id
		// ================ MySql ================
  		// $q = $db->prepare("DELETE FROM `comments` WHERE `id` = ?");
  		// $q->bindParam(1, $id);
		// ================ PostgreSQL ================
		$q = $db->prepare("DELETE FROM comments WHERE id = '$id'");
  		$q->execute();
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function getAllVideosCount(){
  	global $db;
  	//to get someone's videos count
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT COUNT(id) FROM `videos`");
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT COUNT(id) FROM videos");
  		$q->execute();
  		$numVideos = $q->fetch(PDO::FETCH_ASSOC);
		// ================ MySql ================
  		// $numVideos = $numVideos['COUNT(id)'];
		// ================ PostgreSQL ================
  		$numVideos = $numVideos['count'];
  		return $numVideos;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function getRecentVideos($start_item){
  	global $db;
  	$s = $start_item;
  	//Get Recently Added Videos
  	//SELECT videos.id AS vid, title, description, id_owner, vid_loca, thumbnail_loca, date, users.id AS uid, username, fullname FROM videos JOIN users WHERE id_owner = users.id ORDER BY videos.id DESC
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT videos.id AS vid, title, description, id_owner, vid_loca, thumbnail_loca, date, users.id AS uid, username, fullname FROM videos JOIN users WHERE id_owner = users.id ORDER BY videos.id DESC LIMIT ".$s." , 8");
  		//$q->bindParam(1, $s);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT videos.id AS vid, title, description, id_owner, vid_loca, thumbnail_loca, date, users.id AS uid, username, fullname FROM videos JOIN users ON id_owner = users.id ORDER BY videos.id DESC LIMIT 8 OFFSET '$s'");
  		$q->execute();
  		$videos = $q->fetchAll(PDO::FETCH_ASSOC);
  		return $videos;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

}

?>
