<!DOCTYPE HTML>
<html>
	<head>
		<title>Zip Manager</title>
		<meta charset="UTF-8"/>
		<link rel="shortcut icon" href="../assets/img/favicon.ico"/>
        <!-- Icons -->
        <link rel="shortcut icon" href="../assets/img/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="../assets/img/apple-icons/apple-touch-icon-114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/img/apple-icons/apple-touch-icon-144.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/img/apple-icons/apple-touch-icon-114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/img/apple-icons/apple-touch-icon-144.png" />
        <!-- Stylesheets -->
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/global.css" />	
	</head>
	<body>
    <!--Header-->
	<?php $url_add="../"; require '../assets/presets/header.php'; ?>
		<div class="container" style="padding-top:30px;">
			<div class="content">
				<div class="row">
					<div class="login-form">
						<h2>Login</h2>
						<hr>
						<form action='../assets/VerifyLogin.php?type=login' method="post">
							<input class="fullWidth" type="text" name="username" placeholder="Username">
							<input class="fullWidth" type="password" name="password" placeholder="Password">
							</br>
							<button class="btn btn-success fullWidth" type="submit" name="submit">
								Sign in
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
	
<!--Custom Style(from example website)-->
<style type="text/css">
	/*my own*/
	.fullWidth {
		width: 100%;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.container {
		width: 320px;
	}
	/* The white background content wrapper */
	.container > .content {
		background-color: #eddfcb;
		padding: 20px;
		-webkit-border-radius: 10px 10px 10px 10px;
		-moz-border-radius: 10px 10px 10px 10px;
		border-radius: 10px 10px 10px 10px;
		-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
		-moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
		box-shadow: 0 1px 2px rgba(0,0,0,.15);
	}
	.login-form {
		text-align:center;
		margin-left: 65px;
		margin-right: 45px;
	}
	</style>
</html>