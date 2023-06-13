<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $header; ?></title>
		<meta charset="utf-8" lang="en">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="icon" type="image/icon" href="./assets/play.ico">
		<link type="text/css" rel="stylesheet" href="https://necolas.github.io/normalize.css/latest/normalize.css">
		<link type="text/css" rel="stylesheet" href="./css/style.css">
	</head>
<body>
	<nav class="clearfix">
		<div class="wrapper">
		    <ul>
				<li class="wlogo">
					<a href="index.php"><img src="assets/play.jpg"><span>Filma</span></a>

				</li>

				<li style="text-align:center">
				    <?php if(get_session('username') == "admin"): ?>
						<b>Admin Panel</b>
					<?php else: ?>
						<form action="search.php" method="GET">
							<input type="text" name="s"></input>
							<input type="submit" value="search"></input>
					    </form>
					<?php endif; ?>
				</li>
				
				<li style="text-align:right">
					<?php if(!loggedin()): ?>
							<a href="../../register.php">S'inscrire</a>
							<span class="separate">|</span>
							<a href="../../login.php">Connexion</a>
                    <?php elseif(get_session('username') == "admin"): ?>
						    <a href="../../logout.php">Logout</a>
					<?php else: ?>
							<a href="upload.php?id=<?=get_session('id')?>"><img src="./assets/upload.png"></a>
							<span class="separate">|</span>
							<a href="profile.php?username=<?=get_session('username')?>"><?=get_session('username')?></a>
							<span class="separate">|</span>
							<a href="../../logout.php">Logout</a>
					<?php endif; ?>
				</li>
		     </ul>
		</div>
    </nav>

<div class="wrapper">
<?php
	if(get_session('error')){
		echo '<div class="wrapper"><div class="error">'.get_error_msg().'</div></div>';
	}
?>
