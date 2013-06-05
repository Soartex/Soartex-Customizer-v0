<?php
//check user login
session_start();
if (!$_SESSION['logged']) {
	header("Location: ../../");
	exit ;
}
?>
<?php
// Get data
$string = file_get_contents("../../data/data.json");
$json_a = json_decode($string, true);
?>
<?php
// Modifying a new Tab
if (isset($_POST['submitModify'])) {
	if (isset($_POST['TabName']) && isset($_POST['TextureName']) && isset($_POST['AltName'])) {
		// Updating Alt Name
		if ($_POST['ModifyAltNameInput'] !== "") {
			//loop and find alt
			for ($i = 0; $i < count($json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data']); ++$i) {
				if ($_POST['AltName'] === $json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data'][$i]['name']) {
					$json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data'][$i]['name'] = $_POST['ModifyAltNameInput'];
					//output file
					$fp = fopen('../../data/data.json', 'w');
					fwrite($fp, json_encode($json_a));
					fclose($fp);
					header("Location: ../../#".$_POST['TabName']);
					exit ;
				}
			}
		} else {
			header("Location: ../../");
			exit ;
		}
	}
}
// If deleting a selected alt
else if (isset($_POST['submitDelete'])) {
	// Loop and find the alt to remove
	for ($i = 0; $i < count($json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data']); ++$i) {
		// Find alt in array
		if ($_POST['AltName'] === $json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data'][$i]['name']) {
			// Delete the file, remove the data	
			unlink ("../../".$json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data'][$i]['url']);
			unset($json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data'][$i]);
			//output file
			$fp = fopen('../../data/data.json', 'w');
			fwrite($fp, json_encode($json_a));
			fclose($fp);
			header("Location: ../../#".$_POST['TabName']);
			exit ;
		}
	}
}
// If the user is adding a new texture
else if (isset($_POST['submitAddAlt']) && $_POST['AltTextureNameInput'] !== "" && isset($_FILES["myimage"])) {
	// Check for errors
	if ($_FILES["myimage"]["error"] > 0) {
		header("Location: ../../");
		exit ;
	}
	// Keep going
	else {
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$extension = end(explode(".", $_FILES["myimage"]["name"]));
		// Limit the file type
		if ((($_FILES["myimage"]["type"] == "image/gif") || ($_FILES["myimage"]["type"] == "image/jpeg") || ($_FILES["myimage"]["type"] == "image/jpg") || ($_FILES["myimage"]["type"] == "image/pjpeg") || ($_FILES["myimage"]["type"] == "image/x-png") || ($_FILES["myimage"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
			//echo "Upload: " . $_FILES["myimage"]["name"] . "<br>";
			//echo "Size: " . ($_FILES["myimage"]["size"] / 1024) . " kB<br>";
			$newLocation = "data/textures/" . time() . '.' . $extension;
			if (!file_exists(dirname("../../".$newLocation))) {
				mkdir(dirname("../../".$newLocation), 0777, TRUE);
			}
			// Move the uploaded file
			move_uploaded_file($_FILES["myimage"]["tmp_name"], "../../".$newLocation);
			// Update data
			array_push($json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data'], array('name' => $_POST['AltTextureNameInput'], 'url' => $newLocation));
			//output file
			$fp = fopen('../../data/data.json', 'w');
			fwrite($fp, json_encode($json_a));
			fclose($fp);
			header("Location: ../../#".$_POST['TabName']);
			exit ;
		}
	}
} else {
	header("Location: ../../");
	exit ;
}
?>