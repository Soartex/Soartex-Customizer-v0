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
		<title>Soartex Customizer</title>
		<link rel="shortcut icon" href="./img/favicon.ico"/>
		<!--Style Sheets-->
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.min.css">
		<!--Google Analitics-->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-39887626-8']);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<!--End of Google Analitics-->
		<!--Google Analitics Link Code-->
		<script type="text/javascript">
			function trackOutboundLink(link, category, action) {

				try {
					_gaq.push(['_trackEvent', category, action]);
				} catch(err) {
				}

				//setTimeout(function() {
				//	window.open('', '_newtab').location.href=link.href;
				//window.focus();
				//document.location.href = link.href;
				//}, 300);
			}
		</script>
		<!--End of Google Analitics Link Code-->
	</head>
	<body>
		<div class="container">
			<!--Page Header-->
			<div class="page-header" href="http://customizer.soartex.net">
				<h1><img src="./img/soar.png"/> Soartex Fanver <small>Customizer Pack Creation</small></h1>
			</div>
			<!--Do the work-->
			<?php
			// Include the helper
			include './Helper.php';
			//Make sure there is data in the post
            if(sizeof($_POST)){
        
				// Get data to display
				$string = file_get_contents("../data/data.json");
				$json_a = json_decode($string, true);

				// Create user's folder
				$folder = '/workfolder/' . time();
				$folder_textures = '/files';
				$folder_export = '/export';
				mkdir($folder, 0777, TRUE);

				//Copy pack additional textures
				echo '<div class="alert alert-info">Please wait while we add pack textures.</div>';
				//Misc folder
				if (!file_exists("../data/packadditions/")) {
					mkdir("../data/packadditions/", 0777, TRUE);
				}
				//Texture copy folder
				if (!file_exists('../'.$folder . $folder_textures . '/')) {
					mkdir('../'.$folder . $folder_textures . '/', 0777, TRUE);
				}
				//copy everything
				recurse_copy("../data/packadditions/",'../'.$folder . $folder_textures . '/');
				
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
										$textureUrl = "../" . $author['url'];
									}
								}
								// Copy texture
								if (isset($texture['export'])) {
									$export = '../'.$folder . $folder_textures . '/' . $texture['export'];
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
				include_once ('./Zip_Archiver.php');
				$export = $folder . $folder_export . '/Soartex_Fanver_Customized.zip';
				$zip_folder = '../'.$folder . $folder_textures . '/';
				// Make the export directory
				mkdir(dirname('../'.$export), 0777, TRUE);
				// Zip folder
				Zip_Archiver::Zip($zip_folder, '../'.$export);

				echo '<div class="alert alert-info">Please wait while we clean up.</div>';
				// Clean up the copy folder
				rrmdir($zip_folder);
				// Remove all old download folders
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
				?>
				<!--Done! Time-->
				<div class="alert alert-info">Done! In <?php echo $total_time; ?> seconds</div>
               <!--Adfly Pack Link-->
                <div class="alert alert-success">Download your pack and suport us: 
                	<i class="icon-heart"></i> 
                	<a target="_blank" href="http://adf.ly/1347518/<?php echo $_SERVER['SERVER_NAME'] . $export; ?>" onClick="window.open('', '_newtab').location.href=this.href; trackOutboundLink(this, 'Outbound Links', 'Adfly Download'); return false;">adfly</a> 
                	<i class="icon-heart"></i>
                </div>
				<!--Go back-->
                <div class="alert alert-info">Go back <b><a href="../">here</a></b></div>
				
				<!--Direct-->
                <div style="position: relative;">
	                <div id="delayedText1" style="visibility:visible;position:absolute;top:0;left:0;width:100%;display:inline;">
	                	<div class="alert alert-info">Download your pack directly in <div style="display:inline;" id="timer_div">15</div> seconds</div>
	                </div>
                	<div id="delayedText2" style="visibility:hidden;position:absolute;top:0;left:0;width:100%;z-index: 10;">
                		<div class="alert alert-success">Download your pack and <b>NOT</b> support us: <a target="_blank" href="<?php echo '../' . $export; ?>" onClick="window.open('', '_newtab').location.href=this.href; trackOutboundLink(this, 'Outbound Links', 'Direct Download'); return false;">Direct</a></div>
                	</div>
                </div>
                <!--Countdown code-->
                <script>
					// Seconds to count down
					var seconds_left = 15;
					var interval = setInterval(function() {
						document.getElementById('timer_div').innerHTML = --seconds_left;
						if (seconds_left <= 0) {
							// Set the timer to 0
							document.getElementById('timer_div').innerHTML = '0';
							//Display one, hide the other
							document.getElementById("delayedText1").style.visibility = "hidden";
							document.getElementById("delayedText2").style.visibility = "visible";
							clearInterval(interval);
						}
					}, 1000);
                </script>
                <?php
				// If post not submited send the user home
				}else {
				header("Location: ../");
				exit ;
				}
			?>
			<footer>
				<br>
				<hr>
				<ul class="nav nav-pills">
					<li class="pull-left">
						<a href="">&copy; Soartex 2013-2014 (Created for the Soartex Team)</a>
					</li>
				</ul>
			</footer>
		</div>
	</body>
</html>