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
if (isset($_POST['TabNameInput']) && isset($_POST['TabName'])) {
	// Modifying a new Tab
	if (isset($_POST['submitModify'])) {
		// Adding a new tab
		if ($_POST['TabName'] === "New Tab") {
			if ($_POST['TabNameInput'] !== "") {
				// Add data
				$json_a[str_replace(' ', '_', $_POST['TabNameInput'])]['name'] = str_replace(' ', '_', $_POST['TabNameInput']);
				$json_a[str_replace(' ', '_', $_POST['TabNameInput'])]['data'];
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
		//modifying an old tab, if a new name is typed
		else if ($_POST['TabNameInput'] !== "") {
			// Copy data
			$json_a[str_replace(' ', '_', $_POST['TabNameInput'])] = $json_a[$_POST['TabName']];
			$json_a[str_replace(' ', '_', $_POST['TabNameInput'])]['name'] = str_replace(' ', '_', $_POST['TabNameInput']);;
			unset($json_a[$_POST['TabName']]);
			// Sort
			ksort($json_a);
			// Output file
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
	// If deleting a selected tab
	else if (isset($_POST['submitDelete'])) {
		// Impossible to delete a tab that isn't created
		if ($_POST['TabName'] !== "New Tab") {
			// Loop and find the catagory to remove
			foreach ($json_a as $key => $value) {
				if ($value['name'] === $_POST['TabName']) {
					unset($json_a[$key]);
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