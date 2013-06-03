<?php
//check user login
session_start();
if (!$_SESSION['logged']) {
	header("Location: ../");
	exit ;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Soartex Customizer 2.0v</title>
		<link rel="shortcut icon" href="../assets/img/favicon.ico"/>
		<!--Style Sheets-->
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/mainindex.css">
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
				<h1><img src="../assets/img/soar.png"/> Soartex Fanver <small>Customizer ADMIN</small></h1>
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
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>