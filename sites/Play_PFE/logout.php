<?php
require('inc/connection.php');
require('inc/function.php');

unset_login_session();
session_destroy();


redirect_to('index');
?>
