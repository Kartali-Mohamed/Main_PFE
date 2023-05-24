<?php
require('inc/connection.php');
require('inc/function.php');
require('inc/user.php');

if(isset($_GET['status'])){
	$header = "Thanks";
	if($_GET['status']=='thanks'){
		echo '<br><br><br><br>';
		echo '<h1><center>:)</h1>';
		echo '<p><center>Enregistré avec Succès !!</p>';
		die();
	}
}

//if already Loggedin redirect to the main page
if(loggedin())
	redirect_to('index');


if($_SERVER["REQUEST_METHOD"] == "POST"){
	//Filtering input
	$fullname = htmlspecialchars(strip_tags($_POST["fullname"]));
	$username =  htmlspecialchars(strip_tags($_POST["username"]));
    $email = 	strtolower(trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL)));
    $password = $_POST["password"];
    $password_again = $_POST["password_again"];

	//Password Hash
	$password = md5($password);
	$password_again = md5($password_again);

	//Check if empty
	if(empty($fullname)|| empty($username)|| empty($email)|| empty($password)|| empty($password_again)){
		set_error_msg("Veuillez remplir les champs obligatoires : Nom complet, Nom d'utilisateur, Email et Mot de passe.");
		redirect_to('register');
	}elseif($password!=$password_again){
		set_error_msg("Mot de passe ne correspond pas.");
		redirect_to('register');
	}else if(strlen($password)<=4){
		set_error_msg("Mot de passe est trop court.");
		redirect_to('register');
	}

	$user = new User();
	//check if the username already exist
	$user = $user->getUserData($username , "register");
	if(!empty($user->username)){
			set_error_msg("Ce Nom d'utilisateur est déjà pris. Essaie un autre.");
			redirect_to('register');
	}


	//send the user data to the database
	$user->register($username, $email, $password, $fullname);
	
	// Redirect to thanks page
	header('Location: register.php?status=thanks');

}
load_view('register');
?>