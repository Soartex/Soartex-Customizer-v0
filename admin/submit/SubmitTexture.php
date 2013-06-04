<?php
//check user login
session_start();
if (!$_SESSION['logged']) {
	header("Location: ../../");
	exit ;
}
?>
<?php
// Get data to display
$string = file_get_contents("../../data/data.json");
$json_a = json_decode($string, true);
?>
<?php
//Check if there is info
if (isset($_POST['TextureNameInput']) && isset($_POST['TextureName']) && isset($_POST['TabName']) && isset($_POST['TextureExport'])) {
	// Modifying a new Tab
	if (isset($_POST['submitModify'])) {
		// Adding a new tab
		if ($_POST['TextureName'] === "New Texture") {
			if ($_POST['TextureNameInput'] !== "" && $_POST['TextureExport'] !== "") {
				// Add data
				$json_a[$_POST['TabName']]['data'][$_POST['TextureNameInput']]['name'] = $_POST['TextureNameInput'];
				$json_a[$_POST['TabName']]['data'][$_POST['TextureNameInput']]['export'] = $_POST['TextureExport'];
				$json_a[$_POST['TabName']]['data'][$_POST['TextureNameInput']]['data'] = Array();
				//sort
				ksort($json_a[$_POST['TabName']]['data']);
				//output file
				$fp = fopen('../../data/data.json', 'w');
				fwrite($fp, json_encode($json_a));
				fclose($fp);
				header("Location: ../../");
				exit ;
			} else {
				header("Location: ../../");
				exit ;
			}
		}
		// Updating Parts
		else {
			//update export
			if ($_POST['TextureExport'] !== "") {
				$json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['export'] = $_POST['TextureExport'];
				//output file
				$fp = fopen('../../data/data.json', 'w');
				fwrite($fp, json_encode($json_a));
				fclose($fp);
			}
			//update name
			if ($_POST['TextureNameInput'] !== "") {
				$json_a[$_POST['TabName']]['data'][$_POST['TextureNameInput']] = $json_a[$_POST['TabName']]['data'][$_POST['TextureName']];
				$json_a[$_POST['TabName']]['data'][$_POST['TextureNameInput']]['name'] = $_POST['TextureNameInput'];
				unset($json_a[$_POST['TabName']]['data'][$_POST['TextureName']]);
				//sort
				ksort($json_a[$_POST['TabName']]['data']);
				//output file
				$fp = fopen('../../data/data.json', 'w');
				fwrite($fp, json_encode($json_a));
				fclose($fp);
			}
		}
		header("Location: ../../");
		exit ;
	}
	// If deleting a selected texture
	else if (isset($_POST['submitDelete'])) {
		// Impossible to delete a tab that isn't created
		if ($_POST['TabName'] !== "New Texture") {
			// Loop and find the catagory to remove
			foreach ($json_a[$_POST['TabName']]['data'] as $key => $value) {
				if ($value['name'] === $_POST['TextureName']) {
					unset($json_a[$_POST['TabName']]['data'][$key]);
					//output file
					$fp = fopen('../../data/data.json', 'w');
					fwrite($fp, json_encode($json_a));
					fclose($fp);
					header("Location: ../../");
					exit ;
				}
			}
		} else {
			header("Location: ../../");
			exit ;
		}
	} else {
		header("Location: ../../");
		exit ;
	}
} else {
	header("Location: ../../");
	exit ;
}
?>