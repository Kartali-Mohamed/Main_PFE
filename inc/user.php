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
    global $db_main;
    global $db;
  	try{
		// ================ MySql ================
  		// $qm = $db_main->prepare("SELECT `id`, `username`, `fullname`, `email` FROM `users` WHERE `username` = ? AND `password` = ? AND `is_verified` = 1");
      // $qm->bindParam(1, $username);
  		// $qm->bindParam(2, $password);
		// ================ PostgreSQL ================
		$qm = $db_main->prepare("SELECT id, username, fullname, email FROM users WHERE username = '$username' AND password = '$password'");
    $qm->execute();
  	$result = $qm->fetch(PDO::FETCH_ASSOC);
		$this->infoSetter($result);
      return $this;
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }

  function register($username, $email, $password, $fullname){
  	global $db;
    global $db_main;
    
  	try{
  	//INSERT INTO `users`(`username`, `email`, `password`) VALUES ([value-1],[value-2],[value-3])
		// ================ MySql ================
      // $qm = $db_main->prepare("INSERT INTO `users` (`username`, `fullname`, `email`, `password`,`is_verified`) VALUES (?, ?, ?, ?,false)"); 		
      // $q = $db->prepare("INSERT INTO `users` (`username`, `fullname`, `email`, `password`) VALUES (?, ?, ?, ?)");
      // $q->bindParam(1, $username);
      // $q->bindParam(2, $fullname);
      // $q->bindParam(3, $email);
      // $q->bindParam(4, $password);
      // //-------
      // $qm->bindParam(1, $username);
      // $qm->bindParam(2, $fullname);
      // $qm->bindParam(3, $email);
      // $qm->bindParam(4, $password);
		// ================ PostgreSQL ================
		  $qm = $db_main->prepare("INSERT INTO users (username, fullname, email, password) VALUES ('$username', '$fullname', '$email', '$password')");
		  $qm->execute();
      $q = $db->prepare("INSERT INTO users (username, fullname, email, password) VALUES ('$username', '$fullname', '$email', '$password')");
      $q->execute();
  	}catch(Exception $e){
  		$error_message[] = "Error : ".$e->getMessage();
  	}
  }
  function getUserData($username , $type){
    global $db_main;
    //Check if profile username exist
    try{
      // ================ MySql ================
      // $q = $db_main->prepare("SELECT `id`, `username`, `fullname`, `email` FROM `users` WHERE `username` = ?");
      // $q->bindParam(1, $username);
      // ================ PostgreSQL ================
        $qm = $db_main->prepare("SELECT id, username, fullname, email FROM users WHERE username = '$username'");
        $qm->execute();
      if( $type == "register"){
          $result = $qm->fetchAll(PDO::FETCH_ASSOC);
          $this->infoSetter($result);
      } elseif($type == "profile") {
          $result = $qm->fetch(PDO::FETCH_ASSOC);
          $this->infoSetter($result);
      }
    return $this;
    }catch(Exception $e){
        $error_message[] = "Error : ".$e->getMessage();
    }
}

}

?>