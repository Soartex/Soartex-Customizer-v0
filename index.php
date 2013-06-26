<?php
// Start User Session
// Used for login
session_start();
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
<?php require 'assets/presets/header.php'; ?>
<div class="container" style="padding-top:30px;">
  <div class="main-content">
    <h1>Soartex Fanver <small>Customizer</small></h1>
    <hr>
		<?php
		// Get data to display
		$string = file_get_contents("data/data.json");
		$json_a = json_decode($string, true);
		?>
			<!--Main Forum and Customizer-->
			<form action="./assets/CreatePack.php" method="post">
				<!--Tab Names-->
				<ul class="nav nav-pills" style="padding-bottom: 10px;">
					<li class="active">
						<a data-toggle="tab" href="#Info" onclick="trackTab(this.href.split('#')[1]);">Info</a>
					</li>
					<?php
					// Create a tab for each group
					foreach ($json_a as &$item) {
						echo '<li><a data-toggle="tab" href="#' . $item['name'] . '" onclick="trackTab(this.href.split(\'#\')[1]);">' . $item['name'] . '</a></li>';
					}
					?>
					<li>
						<a data-toggle="tab" class="submit" href="#Submit" onclick="trackTab(this.href.split('#')[1]);">Submit</a>
					</li>
					<?php
					// If logged in then allow to modfiy the catagories
					if (isset($_SESSION['logged']) && $_SESSION['logged']) {
						echo '<li>';
						echo '<a href="./admin/ModifyCategory.php">Modify</a>';
						echo '</li>';
						// Logout button (only if you are logged in)
						echo '<li class="pull-right">';
						echo '<a href="assets/VerifyLogin.php?type=logout">Logout</a>';
						echo '</li>';
					}
					// Login button (show only if not logged in)
					else {
						echo '<li class="pull-right">';
						echo '<a href="./login/">Login</a>';
						echo '</li>';
					}
					?>
				</ul>
				<!--Nice Division-->
				<hr>
				<!--Tab Content-->
				<div class="tab-content" style="overflow: visible;">
					<?php
                    // Create a tab for each group
                    foreach ($json_a as &$item) {
                    echo '<div class="tab-pane" id="'.$item['name'].'">';
                    echo '<!--Thumbnail List-->';
                    echo '<ul class="thumbnails">';
                    // Go through data and display each texture
                    if(isset($item['data'])){
                    foreach ($item['data'] as &$texture) {
                    echo '<li>';

                    echo '<div class="thumbnail">';
                    // Texture Picture (default to first texture)
                    if(isset($texture['data'][0])){
                    echo '<a href="'.$texture['data'][0]['url'].'" id="'.$item['name'].$texture['name'].'2" target="_blank">';
                    echo '<img class="textureImg" src="'.$texture['data'][0]['url'].'" id="'.$item['name'].$texture['name'].'" />';
                    echo '</a>';
                    }

                    echo '<div class="caption">';
                    // Texture name & select dropdown
                    echo '<h4>'.$texture['name'].'</h4>';
					?>
					<!--onmouseover="this.size=3" onmouseout="this.size=3"-->
					<select muliple size="3" name="<?php echo $item['name'].$texture['name']?>"
					onChange="document.getElementById('<?php echo $item['name'].$texture['name']?>').src=this.options[this.selectedIndex].getAttribute('data-whichPicture'); document.getElementById('<?php echo $item['name'].$texture['name']?>2').href=this.options[this.selectedIndex].getAttribute('data-whichPicture');" >
					<?php
					// Check to see if data is there
					if (isset($texture['data'])) {
						// Add all alt textures
						$first = true;
						foreach ($texture['data'] as &$author) {
							// Auto select the first one
							if ($first) {
								echo '<option title="' . $author['name'] . '" selected data-whichPicture=' . $author['url'] . ' >' . $author['name'] . '</option>';
								$first = false;
							}
							// Add rest normally
							else {
								echo '<option title="' . $author['name'] . '"  data-whichPicture=' . $author['url'] . ' >' . $author['name'] . '</option>';
							}
						}
					}
					echo '</select>';
					// If logged in then allow to modfiy a alt
					if (isset($_SESSION['logged']) && $_SESSION['logged']) {
						echo '<a class="btn btn-info" style="width:155px;" href="./admin/ModifyAlternative.php?tab=' . $item['name'] . '&texture=' . $texture['name'] . '">Modify</a>';
					}
					echo '</div></div>';
					echo '</li>';
					}
					}
					// If loggged in then allow to modfiy a texture
					if(isset($_SESSION['logged']) && $_SESSION['logged']){
					echo '<li>';
					echo '<div class="thumbnail" style="background-color:rgba(61, 165, 194, .1);">';
					echo '<img src="./assets/img/16x16(noimage).gif" />';
					echo '<div class="caption">';
					echo '<h4>Texture Name</h4>';
					echo '<select muliple size="3" style="width: 100%;" ></select>';
					echo '<a class="btn btn-info" style="width:155px;" href="./admin/ModifyTexture.php?tab='.$item['name'].'">Update Textures</a>';
					echo '</div>';
					echo '</div>';
					echo '</li>';
					}
					echo '</ul>';
					echo '</div>';

					}
					?>
					<!-- Info Page -->
					<div class="tab-pane active" id="Info">
						<p>
							<h3><b>Welcome to the Soartex Customizer!</b></h3>
							<br>
							This website is designed to provide any pack user to 'customize' their textures.  You can do so by browsing through the tabs. Within each tab is a texture. You can select an alternate texture if it is available. If the preview image of the texture is too small, feel free to click on the image to get a full size texture. Once you are done changing your pack, head to the submit page. Click the button and your pack will be created for you. It may take a bit but please be patient; we try to make sure that your pack is high quality for you. After your pack has been created, download and enjoy!
							<br>
							<br>
							<b>If you would like to see more alternate textures made:</b>
							<br>
							Feel free to check out the soartex forums at <a href="http://soartex.net">soartex.net</a>. We are always trying to provide the highest quality of textures for the user and if you would like to help by contributing feel free to stop by. This is a community effort and we cannot do it without the help of you.
							<br>
							<br>
							<b>If you would like to have mod textures:</b>
							<br>
							We have created an application that allows you to conveniently download and install our huge repertoire of mod support. Feel free to download the mod patcher from <a href="http://files.soartex.net/texture-patcher/soartex/Soartex-Texture-Patcher-1.2.jar">here</a>, or have access to all mod files at <a href="http://files.soartex.net/mods/">files.soartex.net/mods/</a>
						</p>
					</div>
					<!-- Submit Page -->
					<div class="tab-pane" id="Submit">
						<h3><b>Done??</b></h3>
						If you are sure you have created your pack to your liking feel free to press the button below. We created your pack based on the options you have chosen on this website. You might notice that in-game there are more textures then you chose on this website. All textures that do not have alts are automatically added. This is to provide a fuller experience for the player/user.
						<br>
						<br>
						Please note that when you use the customizer almost all ctm, random texture are removed because of the possibility for incompatibility. If you want to experience the full soartex fanver pack, feel free to download our primary pack.
						<br>
						<br>
						Enjoy your creation!
						<br>
						<br>
						<input class="btn btn-success btn-large btn-block" type="submit" name="sub" onclick="disableButtons();" value="Create Pack!"/>
					</div>
				</div>
			</form>
		</div>		
	</div>
<!-- Footer -->
<?php require 'assets/presets/footer.php'; ?>
</body>
<!-- Javascripts -->
<script src="assets/js/main.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
</html>