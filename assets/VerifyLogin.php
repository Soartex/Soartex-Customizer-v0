<?php
if (isset($_GET['type'])) {
	// If loging in
	if ($_GET['type'] === "login" && isset($_POST['submit'])) {
		//if pass and username match start the session
		if ($_POST['username'] == 'admin' && $_POST['password'] == 'superuser') {
			session_start();
			$_SESSION['logged'] = TRUE;
			$_SESSION['username'] = $_POST['username'];
			// Redirect to the home pages
			header("Location: ../");
			exit ;
		} else {
			header("Location: ../");
			exit ;
		}
	}
	// If logging out
	else if ($_GET['type'] === "logout") {
		session_start();
		if ($_SESSION['logged']) {
			$_SESSION['logged'] = FALSE;
		}
		header("Location: ../");
		exit ;
	} 
	// If it is an invalid type the redirect to home
	else {
		header("Location: ../");
		exit ;
	}
} else {
	header("Location: ../");
	exit ;
}
?>