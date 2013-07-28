<?php 
$url_add=""; 
require 'assets/cake/cake.php';
$edit_content=false;
if(isUserLoggedIn()) {
	$edit_content = $loggedInUser->checkPermission(array(2,4));
}
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
    <h1>Soartex Fanver <small>Customizer x.x</small></h1>
    <hr>
		<?php
		// Get data to display
		$string = file_get_contents("data/data.json");
		$json_a = json_decode($string, true);
		?>
			<!--Main Forum and Customizer-->
			<form action="./CreatePack.php" method="post">
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
					if ($edit_content) {
						echo '<li>';
						echo '<a href="./admin/ModifyCategory.php">Modify</a>';
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
					if ($edit_content) {
						echo '<a class="btn btn-info" style="width:155px;" href="./admin/ModifyAlternative.php?tab=' . $item['name'] . '&texture=' . $texture['name'] . '">Modify</a>';
					}
					echo '</div></div>';
					echo '</li>';
					}
					}
					// If loggged in then allow to modfiy a texture
					if($edit_content){
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

Choose the textures in Soartex! Browse through the tabs above to view groups of similar textures. Each texture has a list of selectable authors below it. Clicking on a texture will make it appear in a separate view, where it can be seen in more detail. Once finished selecting textures, head over to the submit tab.
							<br>
							<br>
							<b>Want more textures to pick from?</b>
							<br>
							We are always adding new textures, thanks to those who contribute their time and effort. There is a centralized forum to post your new textures at <a href="http://soartex.net">soartex.net</a>.
							<br>
							<br>
							<b>Where are the mod textures?</b>
							<br>
							The customizer works great with the Texture Patcher, a standalone program that adds the latest mod textures to your texture pack. Take a look <a href="http://files.soartex.net/texture-patcher/soartex/Soartex-Texture-Patcher-1.2.jar">here</a>, or install and update manually using the raw files here: <a href="http://files.soartex.net/mods/">files.soartex.net/mods/</a>
                            <br>
							<br>
                            <b>Older versions of Minecraft:</b>
                            <br>
                            <ul>
                                <li><a href="http://customizer.soartex.net">Soartex 1.6.x Customizer</a></li>
                                <li><a href="http://customizer1.5.soartex.net">Soartex 1.5.x Customizer</a></li>
                                <li><a href="http://minecraftcustomizer.net/pack/Soartex+Fanver">Soartex 1.4.x Customizer</a></li>
                            </ul>
                        </p>
					</div>
					<!-- Submit Page -->
					<div class="tab-pane" id="Submit">
						<h3><b>Ready?</b></h3>
The green button below will make your texture pack with the selections you chose. Any textures that aren't chosen here are added from the main pack. Unfortunately, randomobs and some of the CTM in the main pack are not added because they clash.
						<br>
						<br>
					
					Enjoy your creation! ...Nice choices, by the way.
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
</html>