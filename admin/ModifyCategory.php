<?php 
$url_add="../"; 
require '../assets/cake/cake.php';
$edit_content=false;
if(isUserLoggedIn()) {
	if(!$loggedInUser->checkPermission(array(2,4))){
		header("Location: ../");
		exit ;	
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Soartex Customizer 2.0v</title>
		<link rel="shortcut icon" href="../assets/img/favicon.ico"/>
		<!--Style Sheets-->
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/mainindex.css">
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            
            ga('create', 'UA-39887626-8', 'soartex.net');
            ga('send', 'pageview');
            
        </script>
    </head>
	<body>
		<?php
		// Get data to display
		$string = file_get_contents("../data/data.json");
		$json_a = json_decode($string, true);
		?>
		<div class="container">
			<!--Page Header-->
			<div class="page-header">
				<h1><img src="../assets/img/soar64.png"/> Soartex Fanver <small>Customizer ADMIN</small></h1>
			</div>
			<!--Main Form-->
			<form action="./submit/SubmitCategory.php" method="post">
				<?php
				echo '<legend>Edit your Category</legend>';
				echo '<label>Select Category</label>';
				echo '<select class="span4" name="TabName">';
				echo '<option selected>New Tab</option>';
				foreach ($json_a as &$item) {
					echo '<option>' . $item['name'] . '</option>';
				}
				echo '</select>';
				echo '</br>';
				echo '<label>Category Name/Rename Category</label>';
				echo '<input class="span4" type="text" placeholder="Tab Name" name="TabNameInput">';
				echo '</br>';
				
				//submit info
				echo '<button class="btn btn-success" type="submit" name="submitModify">Modify</button>  ';
				echo '<button class="btn btn-danger" type="submit" name="submitDelete">Remove</button>';
				?>
			</form>
		</div>
		<!--JavaScript-->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="assets/js/bootstrap.js"></script>
	</body>
</html>