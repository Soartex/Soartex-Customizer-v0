<?php
// Used to measure time to create a pack
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>
<!DOCTYPE html>
<html>
<head>
<title>Soartex Customizer 2.0v</title>
<link rel="shortcut icon" href="./img/favicon.ico"/>
<!--Style Sheets-->
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.min.css">
</head>
<body>
<div class="container">
<!--Page Header-->
<div class="page-header">
<h1><img src="./img/soar.png"/> Soartex Fanver <small>Customizer Pack Creation</small></h1>
</div>
<!--Do the work-->
<?php
			if (isset($_POST['submit'])) {

				// Get data to display
				$string = file_get_contents("../data/data.json");
				$json_a = json_decode($string, true);

				// Create user's folder
				$folder = '../workfolder/' . time();
				$folder_textures = '/files';
				$folder_export = '/export';
				mkdir($folder, 0777, TRUE);
				echo '<div class="alert alert-info">Please wait while we compile your content.</div>';

				// Tab
				foreach ($json_a as &$item) {
					// Texture
					if(isset($item['data'])){
						foreach ($item['data'] as &$texture) {
							// Get info from post
							$textureName = str_replace(' ', '_', $item['name'].$texture['name']);
							if(isset($_POST[$textureName])){
								$selection = $_POST[$textureName];
							}
							// Has to have data inorder to copy something
							if(isset($texture['data']) && count($texture['data'])){
								// Find url to alt texture
								foreach ($texture['data'] as &$author) {
									if ($author['name'] === $selection) {
										$textureUrl = "../" . $author['url'];
									}
								}
								// Copy texture
								if (isset($texture['export'])) {
									$export = $folder . $folder_textures . '/' . $texture['export'];
									// Create Export path
									if (!file_exists(dirname($export))) {
										mkdir(dirname($export), 0777, TRUE);
									}
									// Copy file
									copy($textureUrl, $export);
								}
							}
						}
					}
				}
				
				echo '<div class="alert alert-info">Please wait while we add extras.</div>';
				//Misc folder
				if (!file_exists("../data/misc/")) {
					mkdir("../data/misc/", 0777, TRUE);
				}
				//copy everything
				recurse_copy("../data/misc/",$folder . $folder_textures . '/');
				
				echo '<div class="alert alert-info">Please wait while we compress your pack.</div>';
				// Get the file zipper and make urls
				include_once ('./Zip_Archiver.php');
				$export = $folder . $folder_export . '/Soartex_Fanver_Customized.zip';
				$zip_folder = $folder . $folder_textures . '/';

				// Make the export directory
				mkdir(dirname($export), 0777, TRUE);
				// Zip folder
				Zip_Archiver::Zip($zip_folder, $export);

				// Clean up
				echo '<div class="alert alert-info">Please wait while we clean up.</div>';
				rrmdir($zip_folder);

				// Remove all old folders
				$files2 = glob('../workfolder/*');
				// Print each file name
				foreach ($files2 as $file) {
					//check to see if the file is a folder/directory
					if (is_dir($file)) {
						try {
							// If folder is older then 1 hour ago delete it
							if ((time() - 60 * 60) >= intval(basename($file))) {
								rrmdir($file);
							}
						}
						// An incorrect folder is in the directory. Delete it
						catch(Exception $e) {
							rrmdir($file);
						}
					}
				}

				// Time calculation
				$time = microtime();
				$time = explode(' ', $time);
				$time = $time[1] + $time[0];
				$finish = $time;
				$total_time = round(($finish - $start), 4);
				// Done
				echo '<div class="alert alert-info">Done! In '.$total_time.' seconds</div>';
				// Pack Link
				echo '<div class="alert alert-success">Download your pack <a href="' . $export . '">Direct</a></div>';
				echo '<div class="alert alert-info">Go back <a href="../">here</a></div>';
			} else {
				header("Location: ../");
				exit ;
			}



			?>
		</div>
	</body>
</html>
<?php
//remove recusivly everything in a directory
function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as &$object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir . "/" . $object) == "dir")
					rrmdir($dir . "/" . $object);
				else
					unlink($dir . "/" . $object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}
?>
<?php
function recurse_copy($src, $dst) {
	$dir = opendir($src);
	@mkdir($dst);
	while (false !== ($file = readdir($dir))) {
		if (($file != '.') && ($file != '..')) {
			if (is_dir($src . '/' . $file)) {
				recurse_copy($src . '/' . $file, $dst . '/' . $file);
			} else {
				copy($src . '/' . $file, $dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}
?>