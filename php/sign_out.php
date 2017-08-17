<?php

session_start();
$is = $_SESSION['is'];
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
if($is==1)
	header('Location: ../html/admin_login.html');
else
	header('Location: ../html/login.html');
exit();
?>