<!DOCTYPE html>
<html>
	<head>
		<title>Soartex Customizer 2.0v</title>
		<!--Style Sheets-->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.min.css">
	</head>
	<body>
		<div class="container">
			<!--Page Header-->
			<div class="page-header">
				<h1><img src="assets/img/soar.png"/> Soartex Fanver <small>Customizer Pack Creation</small></h1>
			</div>
			<!--Do the work-->
			<?php
			if (isset($_POST['submit'])) {

				// Get data to display
				$string = file_get_contents("data/data.json");
				$json_a = json_decode($string, true);

				// Create Temp Folder
				$folder = './workfolder/' . time();
				mkdir($folder, 0777, TRUE);
				echo '<div class="alert alert-success">Success: Created Directory</br>' . $folder . '</div>';

				// Tab
				foreach ($json_a as &$item) {
					// Texture
					foreach ($item['data'] as &$texture) {
						// Get info from post
						$textureName = str_replace(' ', '_', $texture['name']);
						$selection = $_POST[$textureName];
						// Find url to alt texture
						foreach ($texture['data'] as &$author) {
							if ($author['name'] === $selection) {
								$textureUrl = "data/" . $author['url'];
							}
						}
						// Copy texture
						if (isset($texture['export'])) {
							$export = $folder . '/' . $texture['export'];
							// Create Export path
							if (!file_exists(dirname($export))) {
								mkdir(dirname($export), 0777, TRUE);
							}
							// Copy file
							copy($textureUrl, $export);
						}
					}
				}
				// Zip folder
				
			} else {
				header("Location: ./index.php");
				exit ;
			}
			?>
		</div>
	</body>
</html>