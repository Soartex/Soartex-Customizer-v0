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
			<form>
				<!--Tab Names-->
				<ul class="nav nav-pills">
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
						<a data-toggle="tab" href="#submitTab">Submit</a>
					</li>
				</ul>
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
					echo '<div class="thumbnail" style="width: 200px;">';		
					// Texture Picture (default to first texture)			
					echo '<img src="data/'.$texture['data'][0]['url'].'" id="'.$texture['name'].'" />';
					echo '<div class="caption">';
					// Texture name & select dropdown
					echo '<h4>'.$texture['name'].'</h4>';
					?>
					<select onmouseover="this.size=this.length" onmouseout="this.size=1" name="<?php echo $texture['name']?>" style="width: 100%;" onChange="document.getElementById('<?php echo $texture['name']?>').src=this.options[this.selectedIndex].getAttribute('data-whichPicture');" >
					<?php
					// Add all alt textures
					foreach ($texture['data'] as &$author) {
						echo '<option data-whichPicture=data/' . $author['url'] . ' >' . $author['name'] . '</option>';
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