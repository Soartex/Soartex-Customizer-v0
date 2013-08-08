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
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-fileupload.css">
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
			<form action="./submit/SubmitAltTexture.php" method="post" enctype="multipart/form-data">
				<?php
				// File upload
				echo '<legend>Upload an Alternative</legend>';
				?>
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new thumbnail" style="width:200px; height:200px;"><img src="../assets/img/200x200(noimage).gif" />
					</div>
					<div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 200px;"></div>
					<div>
						<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
							<input type="file" name="myimage" id="file" />
						</span>
						<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
					</div>
				</div>
				<br>
				<?php
				// Alt Author
				echo '<label>New Alternative Author</label>';
				echo '<input class="span4" type="text" placeholder="Alternative Author" name="AltTextureNameInput">';
				echo '</br>';
				//submit info
				echo '<button class="btn btn-success" type="submit" name="submitAddAlt">Upload</button>  ';
				echo '</br>';
				echo '</br>';

				// Update Textures
				echo '<legend>Edit your Alternatives</legend>';
				// Tab
				echo '<label>Current Tab</label>';
				echo '<select class="span4" name="TabName">';
				echo '<option selected>' . $_GET['tab'] . '</option>';
				echo '</select>';
				// Texture
				echo '<label>Current Texture</label>';
				echo '<select class="span4" name="TextureName">';
				echo '<option selected>' . $_GET['texture'] . '</option>';
				echo '</select>';
				echo '</br>';
				// Alt Textures
				echo '<label>Current Alternatives</label>';
				echo '<select class="span4" name="AltName">';
				// Get current texture, then get all alts
				$first = true;
				foreach ($json_a[$_GET['tab']]['data'][$_GET['texture']]['data'] as &$alt) {
					if ($first) {
						echo '<option selected>' . $alt['name'] . '</option>';
						$first = false;
					} else {
						echo '<option>' . $alt['name'] . '</option>';
					}
				}
				echo '</select>';
				echo '</br>';
				// Alt Author
				echo '<label>Alternative Author</label>';
				echo '<input class="span4" type="text" placeholder="Alternative Author" name="ModifyAltNameInput">';
				echo '</br>';
				// Submit info
				echo '<button class="btn btn-warning" type="submit" name="submitModify">Modify</button>  ';
				echo '<button class="btn btn-danger" type="submit" name="submitDelete">Remove</button>';
				?>
			</form>
		</div>
		<!--JavaScript-->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="../assets/js/bootstrap.js"></script>
		<script src="../assets/js/bootstrap-fileupload.js"></script>
	</body>
</html>