<?php
// Used to measure time to create a pack
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>
<!-- Copyright Soartex Fanver Team -->
<!DOCTYPE html>
<html>
<head>
<!-- Page information -->
<title>Soartex Fanver</title>
<meta charset="UTF-8"/>
<!-- Icons -->
<link rel="shortcut icon" href="assets/img/favicon.ico" />
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/img/apple-icons/apple-touch-icon-114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/img/apple-icons/apple-touch-icon-144.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/img/apple-icons/apple-touch-icon-114.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/img/apple-icons/apple-touch-icon-144.png" />
<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="assets/css/global.css" />
<link rel="stylesheet" type="text/css" href="assets/css/mainindex.css">
<!-- Google Analytics -->
<script type="text/javascript" src="assets/js/google.js"></script>
<!-- End of Google Analytics -->
</head>
<body>
<!--Header-->
<?php $url_add=""; require 'assets/presets/header.php'; ?>
<div class="container" style="padding-top:30px;">
  <div class="main-content">
    <h1>Soartex Fanver <small>Customizer Pack Creation</small></h1>
    <hr>
			<!--Do the work-->
			<?php
			// Include the helper
			include './assets/Helper.php';
			//Make sure there is data in the post
            if(sizeof($_POST)){
        
				// Get data to display
				$string = file_get_contents("./data/data.json");
				$json_a = json_decode($string, true);

				// Create user's folder
				$folder = '/workfolder/' . time();
				$folder_textures = '/files';
				$folder_export = '/export';
				mkdir($folder, 0777, TRUE);

				//Copy pack additional textures
				echo '<div class="alert alert-info">Please wait while we add pack textures.</div>';
				//Misc folder
				if (!file_exists("./data/packadditions/")) {
					mkdir("./data/packadditions/", 0777, TRUE);
				}
				//Texture copy folder
				if (!file_exists('./'.$folder . $folder_textures . '/')) {
					mkdir('./'.$folder . $folder_textures . '/', 0777, TRUE);
				}
				//copy everything
				recurse_copy("./data/packadditions/",'./'.$folder . $folder_textures . '/');
				
				echo '<div class="alert alert-info">Please wait while we compile your content.</div>';
				// Copy customized files(overwrites additions), Tab
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
										$textureUrl = "./" . $author['url'];
									}
								}
								// Copy texture
								if (isset($texture['export'])) {
									$export = './'.$folder . $folder_textures . '/' . $texture['export'];
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
				
				echo '<div class="alert alert-info">Please wait while we compress your pack.</div>';
				// Get the file zipper and make urls
				include_once ('./assets/Zip_Archiver.php');
				$export = $folder . $folder_export . '/Soartex_Fanver_Customized.zip';
				$zip_folder = './'.$folder . $folder_textures . '/';
				// Make the export directory
				mkdir(dirname('./'.$export), 0777, TRUE);
				// Zip folder
				Zip_Archiver::Zip($zip_folder, './'.$export);

				echo '<div class="alert alert-info">Please wait while we clean up.</div>';
				// Clean up the copy folder
				rrmdir($zip_folder);
				// Remove all old download folders
				$files2 = glob('./workfolder/*');
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
				?>
				<!--Done! Time-->
				<div class="alert alert-info">Done! In <?php echo $total_time; ?> seconds</div>
               <!--Adfly Pack Link-->
                <div class="alert alert-success">Download your pack and support us: 
                	<i class="icon-heart"></i> 
                	<a target="_blank" href="http://adf.ly/1347518/<?php echo $_SERVER['SERVER_NAME'] . $export; ?>" onClick="window.open('', '_newtab').location.href=this.href; trackOutboundLink(this, 'Outbound Links', 'Adfly Download'); return false;">adfly</a> 
                	<i class="icon-heart"></i>
                </div>
				<!--Go back-->
                <div class="alert alert-info">Go back <b><a href="./">here</a></b></div>
                <?php
				// If post not submited send the user home
				}else {
				header("Location: ./");
				exit ;
				}
			?>
			</div>
		</div>
<!-- Footer -->
<?php require './assets/presets/footer.php'; ?>
</body>
<!-- Javascripts -->
<script src="assets/js/main.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
</html>