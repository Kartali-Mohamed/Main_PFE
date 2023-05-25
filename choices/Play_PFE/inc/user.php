<?php
 include('connection.php');
/**
 *
 */
class User
{
  public $id;
  public $username;
  public $fullname;
  public $email;
  public $password;

  function __construct()
  {
    // code...
  }

  function setInfo($id, $username, $fullname, $email)
  {
    $this->id = $id;
    $this->username = $username;
    $this->fullname = $fullname;
    $this->email = $email;
    return $this;
  }

  private function infoSetter($result){
	if (is_array($result)){
		extract($result);
	    $this->setInfo($id, $username, $fullname, $email);
	}
  }

  function login($username, $password){
  	global $db;
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT `id`, `username`, `fullname`, `email` FROM `users` WHERE `username` = ? AND `password` = ?");
  		// $q->bindParam(1, $username);
  		// $q->bindParam(2, $password);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT id, username, fullname, email FROM users WHERE username = '$username' AND password = '$password'");
  		$q->execute();
  		$result = $q->fetch(PDO::FETCH_ASSOC);
		$this->infoSetter($result);
      return $this;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function register($username, $email, $password, $fullname){
  	global $db;
  	try{
  		//INSERT INTO `users`(`username`, `email`, `password`) VALUES ([value-1],[value-2],[value-3])
		// ================ MySql ================
  		// $q = $db->prepare("INSERT INTO `users` (`username`, `fullname`, `email`, `password`) VALUES (?, ?, ?, ?)"); 		
		// $q->bindParam(1, $username);
		// $q->bindParam(2, $fullname);
  		// $q->bindParam(3, $email);
  		// $q->bindParam(4, $password);
		// ================ PostgreSQL ================
		$q = $db->prepare("INSERT INTO users (username, fullname, email, password) VALUES ('$username', '$fullname', '$email', '$password')");
  		$q->execute();
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function getUserData($username , $type){
  	global $db;
  	//Check if profile username exist
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT `id`, `username`, `fullname`, `email` FROM `users` WHERE `username` = ?");
		// $q->bindParam(1, $username);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT id, username, fullname, email FROM users WHERE username = '$username'");
  		$q->execute();
		if( $type == "register"){
			$result = $q->fetchAll(PDO::FETCH_ASSOC);
			$this->infoSetter($result);
		} elseif($type == "profile") {
			$result = $q->fetch(PDO::FETCH_ASSOC);
			$this->infoSetter($result);
		}
      return $this;
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
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT videos.id AS vid, title, description, id_owner, vid_loca, thumbnail_loca, date, users.id AS uid, username, fullname FROM videos JOIN users ON id_owner = users.id ORDER BY videos.id DESC LIMIT '$s' , 8");
  		$q->execute();
  		$videos = $q->fetchAll(PDO::FETCH_ASSOC);
  		return $videos;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function getNumOfVideos($id){
  	global $db;
  	//to get someone's videos count
  	try{
		// ================ MySql ================
  		// $q = $db->prepare("SELECT COUNT(id) FROM videos WHERE id_owner= ?");
  		// $q->bindParam(1, $id);
		// ================ PostgreSQL ================
		$q = $db->prepare("SELECT COUNT(id) FROM videos WHERE id_owner= '$id'");
  		$q->execute();
  		$result = $q->fetch(PDO::FETCH_ASSOC);
  		return $result['count'];
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }
}

?>
