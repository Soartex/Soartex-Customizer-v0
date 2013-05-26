<!DOCTYPE html>
<html>
	<head>
		<title>Soartex Customizer 2.0v</title>
		<!--Style Sheets-->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.min.css">
	</head>
	<body>
		<?php
		// Get data to display
		$string = file_get_contents("data/data.json");
		$json_a = json_decode($string, true);
		?>
		<div class="container">
			<!--Page Header-->
			<div class="page-header">
				<h1><img src="assets/img/soar.png"/> Soartex Fanver <small>Customizer</small></h1>
			</div>
			<!--Main Forum and Customizer-->
			<form action="./createPack.php" method="post">
				<!--Tab Names-->
				<ul class="nav nav-pills" style="padding-bottom: 10px;">
					<li class="active">
						<a data-toggle="tab" href="#info">Info</a>
					</li>
					<?php
					// Create a tab for each group
					foreach ($json_a as &$item) {
						echo '<li><a data-toggle="tab" href="#' . $item['name'] . '">' . $item['name'] . '</a></li>';
					}
					?>
					<li>
						<a data-toggle="tab" style="background-color: rgba(147,197,114, 1); color:white;" href="#submitTab">Submit</a>
					</li>
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
					foreach ($item['data'] as &$texture) {
					echo '<li>';
					echo '<div class="thumbnail" style="width: 200px; padding-top: 15px; background-color: rgba(0, 0, 0, 0.015);">';		
					// Texture Picture (default to first texture)
					echo '<img style="max-width: 64px; max-height: 64px;" src="data/'.$texture['data'][0]['url'].'" id="'.$texture['name'].'" />';
					echo '<div class="caption">';
					// Texture name & select dropdown
					echo '<h4>'.$texture['name'].'</h4>';
					?>
					<!--onmouseover="this.size=3" onmouseout="this.size=3"-->
					<select muliple size="3" name="<?php echo $item['name'].$texture['name']?>" style="width: 100%; this.size=3" onChange="document.getElementById('<?php echo $texture['name']?>').src=this.options[this.selectedIndex].getAttribute('data-whichPicture');" >
					<?php
					// Add all alt textures
					$first = true;
					foreach ($texture['data'] as &$author) {
						// Auto select the first one
						if($first){
							echo '<option selected data-whichPicture=data/' . $author['url'] . ' >' . $author['name'] . '</option>';
							$first = false;
						}
						// Add rest normally
						else{
							echo '<option data-whichPicture=data/' . $author['url'] . ' >' . $author['name'] . '</option>';
						}
					}
					echo '</select>';
					echo '</div></div>';
					echo '</li>';
					}
					echo '</ul>';
					echo '</div>';

					}
					?>
					<!-- Info Page -->
					<div class="tab-pane active" id="info">
						<p>Welcome to the Soartex Customizer.</p>
						<p>This is where a "how-to guide would go".</p>
					</div>
					<!-- Submit Page -->
					<div class="tab-pane" id="submitTab">
						<p>Submit page.</p>
						<p>This is where you would tell the user they are about to make there pack.</p>
						<p>This button here would send to a .php that would then create the texture pack.</p>
						<button class="btn btn-success" type="submit" name="submit">
								Create Pack!
						</button>
					</div>
				</div>

			</form>
		</div>
		<!--JavaScript-->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>