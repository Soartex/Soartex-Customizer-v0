<!DOCTYPE html>
<html>
	<head>
		<title>Soartex Customizer 2.0v</title>
		<!--Style Sheets-->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/mainindex.css">
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
				<h1><img src="assets/img/soar.png"/> Soartex Fanver <small>Customizer ADMIN</small></h1>
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
						<a data-toggle="tab" class="admin" style="background-color: rgba(61, 165, 194, .5);color: black;" href="#adminTab">Add Category</a>
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
					
					echo '<div class="thumbnail">';
					// Texture Picture (default to first texture)
					echo '<a href="data/'.$texture['data'][0]['url'].'" id="'.$item['name'].$texture['name'].'2" target="_blank">';
					echo '<img class="textureImg" src="data/'.$texture['data'][0]['url'].'" id="'.$item['name'].$texture['name'].'" />';
					echo '</a>';
					
					echo '<div class="caption">';
					// Texture name & select dropdown
					echo '<h4>'.$texture['name'].'</h4>';
					?>
					<!--onmouseover="this.size=3" onmouseout="this.size=3"-->
					<select muliple size="3" name="<?php echo $item['name'].$texture['name']?>"
					onChange="document.getElementById('<?php echo $item['name'].$texture['name']?>').src=this.options[this.selectedIndex].getAttribute('data-whichPicture'); document.getElementById('<?php echo $item['name'].$texture['name']?>2').href=this.options[this.selectedIndex].getAttribute('data-whichPicture');" >
					<?php
					// Add all alt textures
					$first = true;
					foreach ($texture['data'] as &$author) {
						// Auto select the first one
						if ($first) {
							echo '<option selected data-whichPicture=data/' . $author['url'] . ' >' . $author['name'] . '</option>';
							$first = false;
						}
						// Add rest normally
						else {
							echo '<option data-whichPicture=data/' . $author['url'] . ' >' . $author['name'] . '</option>';
						}
					}
					echo '</select>';
					echo '<button class="btn btn-info" href="#">Add Alternative</button>';
					echo '</div></div>';
					echo '</li>';
					}
					?>
					<li>
					<div class="thumbnail" style="background-color:rgba(61, 165, 194, .06);">
					<img src='http://placehold.it/64x64' />
					<div class="caption">
					<h4>Texture Name</h4>
					<select name="dpt" style="width: 100%;" ></select>
					<button class="btn btn-info" href="#">Add New Texture</button>
					</div>
					</div>
					</li>
					<?php
					echo '</ul>';
					echo '</div>';

					}
					?>
					<!-- Info Page -->
					<div class="tab-pane active" id="info">
						<p>
							Welcome to the Soartex Customizer Admin page.
						</p>
						<p>
							This is where a "how-to guide" would go.
						</p>
						<p>
							Also it would be mice to explain how the system works.
						</p>
						<p>

							<b>Needs a login page made</b>
						</p>
					</div>
				</div>

			</form>
		</div>
		<!--JavaScript-->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>