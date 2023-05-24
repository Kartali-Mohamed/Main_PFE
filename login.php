<?php
require('inc/function.php');
require('inc/user.php');

//if already Loggedin redirect to the main page
if(loggedin())
	redirect_to('choices');


if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = htmlspecialchars(strip_tags($_POST["username"]));
	$password = $_POST["password"];

	//Check if empty
	if(empty($username)|| empty($password)){
		set_error_msg("Veuillez remplir les champs obligatoires : Nom d'utilisateur et Mot de passe.");
		redirect_to('login');
	}

	//Password Hash
	$password = md5($password);

	//validate username AND password
	$user = new User();
	$user->login($username, $password);
	if(!empty($user->username)){
		//Set cookies if its validate
		set_login_session($user->id, $user->username, $user->fullname);
		//redirect to the main page
		redirect_to('choices');
	}else{
		//Set error msg if its invalidate
		set_error_msg("Nom d'utilisateur / Mot de passe invalide, Réessayez.");
		echo"error";
	}
}

load_view('login');
?>