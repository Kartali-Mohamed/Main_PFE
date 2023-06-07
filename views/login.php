<?php $header = "Login"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ELmahroussaTech</title>
    
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

<style>
@import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700');
 * {
	 padding: 0;
	 margin: 0;
	 outline-width: 0;
	 font-family: 'Roboto';
}
 body {
	 background: #f2f2f2;
}
 #container {
	 background: #f2f2f2;
	 box-sizing: border-box;
	 width: 400px;
	 margin: 320px auto;
	 box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.15);
}
 .tabs {
	 display: flex;
}
 .tabs .tab {
	 flex: 1;
	 text-align: center;
	 padding: 10px 0;
	 box-sizing: border-box;
	 background: #fff;
	 font-size: 18px;
	 font-weight: 400;
	 color: #000;
	 cursor: pointer;
}
 .tabs .tab.current {
	 background: rgb(0, 75, 140);
	 color: #fff;
}
 .form-div {
	 margin-bottom: 15px;
}
 .form-div:last-child {
	 margin-bottom: 0;
}
 .input-area {
	 position: relative;
	 width: 100%;
	 overflow: hidden;
}
 .input {
	 background: #eee;
	 border: none;
	 font-size: 14px;
	 padding: 12px;
	 box-sizing: border-box;
	 width: 100%;
	 transition: 0.3s ease;
	 -webkit-transition: 0.3s ease;
}
 .input:focus {
	 border-color: rgb(0, 75, 140);
	 padding-left: 52px;
}
 .input:focus ~ .input-icon {
	 left: 0;
}
 .input:not(:placeholder-shown) {
	 padding-left: 52px;
}
 .input:not(:placeholder-shown) ~ .input-icon {
	 left: 0;
}
 .input-icon {
	 position: absolute;
	 left: -42px;
	 top: 0;
	 width: 42px;
	 height: 100%;
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 background: rgb(0, 75, 140);
	 color: #fff;
	 transition: 0.3s ease;
	 -webkit-transition: 0.3s ease;
}
 .form-footer {
	 display: flex;
}
 .form-footer button{
	 background: rgb(0, 75, 140);
	 border: none;
	 color: #fff;
	 font-size: 14px;
	 padding: 10px;
	 box-sizing: border-box;
	 font-weight: 400;
	 flex: 1;
	 cursor: pointer;
	 transition: 0.3s ease;
	 -webkit-transition: 0.3s ease;
}
 .form-footer button span:nth-child(2) {
	 padding-left: 5px;
}
 .form-footer button:nth-child(1) {
	 margin-right: 10px;
}
 .form-footer button:nth-child(2) {
	 margin-left: 10px;
}
 .form-footer button:hover {
	 background: rgb(0, 75, 140);
}
 .register .form-footer button:first-child {
	 margin-right: 0;
}
 .tab-content {
	 display: none;
	 background: #fff;
	 padding: 15px;
}
 .tab-content.current {
	 display: inherit;
}
.button{
	background-color: rgb(0, 75, 140);
	font-weight:bold ;
	color: white;
	border : none;
}

a{
	background-color: rgb(0, 75, 140);
	font-weight:bold ;
	color: white;
	border : none;
}
.error{
	padding:25px 0;
	margin:10px 0;
	text-align:center;
	background-color: yellow;
	opacity:0.5;
}

 
 
</style>
</head>
<body>
    <div class="text-center logo-container"> </div>
    <div id="container">
        <h3 class="text-center">Mahroussa tech</h3>
        <div class="tabs">
            <div class="tab tab-link current" data-tab="tab-1">Connexion</div>
            <div class="tab tab-link" data-tab="tab-2">S'inscrire</div>
        </div>
        <form class="tab-content current login" id="tab-1" method="POST" action="login.php">
            <div class="form-div">
                <div class="input-area">
                    <input class="input" type="text" name="username" placeholder="Username" />
                    <div class="input-icon fa fa-user"></div>
                </div>
            </div>
            <div class="form-div">
                <div class="input-area">
                    <input class="input" type="password" name="password" placeholder="Mot de passe" />
                    <div class="input-icon fa fa-lock"></div>
                </div>
            </div>
            <div class="form-footer">
                <button> <span><a href="verification.php">Mot de passe oublié?</a></span><span class="fa fa-question"></span></button>
                <button> <span><input class="button" type="submit" value="Connexion"></span><span class="fa fa-sign-in"></span></button>
            </div>
        </form>

        <form class="tab-content register" id="tab-2"  method="POST" action="register.php">
		<div class="form-div">
                <div class="input-area">
                    <input class="input" name="fullname" type="text" placeholder="Fullname" />
                    <div class="input-icon fa fa-user"></div>
                </div>
            </div>
            <div class="form-div">
                <div class="input-area">
                    <input class="input" name="username" type="text" placeholder="Username" />
                    <div class="input-icon fa fa-user"></div>
                </div>
            </div>
            <div class="form-div">
                <div class="input-area">
                    <input class="input" name="email" type="email" placeholder="Email" />
                    <div class="input-icon fa fa-envelope"></div>
                </div>
            </div>
            <div class="form-div">
                <div class="input-area">
                    <input class="input" type="password"  name="password" placeholder="Password" />
                    <div class="input-icon fa fa-lock"></div>
                </div>
            </div>
			<div class="form-div">
                <div class="input-area">
                    <input class="input" type="password"  name="password_again" placeholder="Password Again" />
                    <div class="input-icon fa fa-lock"></div>
                </div>
            </div>
            <div class="form-footer">
                <button> <span><input class="button" type="submit" value="Enregistrer"></span><span class="fa fa-user-plus"></span></button>
            </div>
        </form>
    </div>
    <script>document.querySelectorAll('.tab').forEach(tab => {
        const tabId = tab.getAttribute('data-tab');

        tab.addEventListener('click', e => {
            document.querySelectorAll('.tab, .tab-content').forEach(e => e.classList.remove('current'));
            tab.classList.add('current');
            document.querySelector(`#${tabId}`).classList.add('current');
        })
    })</script>
	
</body>
</html>