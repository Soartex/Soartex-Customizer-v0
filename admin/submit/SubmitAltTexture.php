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
					header("Location: ../../");
					exit ;
				}
			}
		} else {
			header("Location: ../../");
			exit ;
		}
	}
}
// If deleting a selected tab
else if (isset($_POST['submitDelete'])) {
	// Loop and find the alt to remove
	for ($i = 0; $i < count($json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data']); ++$i) {
		// Find alt in array
		if ($_POST['AltName'] === $json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data'][$i]['name']) {
			unset($json_a[$_POST['TabName']]['data'][$_POST['TextureName']]['data'][$i]);
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
?>