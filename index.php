<!DOCTYPE html>
<html>
	<head>
		<title>Soartex Customizer 2.0v</title>
		<!--Style Sheets-->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.min.css">
	</head>
	<body>
		<div class="container">
			<form>
				<!--Tab Names-->
				<ul class="nav nav-pills">
					<li class="active">
						<a data-toggle="tab" href="#tab1">Blocks 1</a>
					</li>
					<li>
						<a data-toggle="tab" href="#tab2">Blocks 2</a>
					</li>
					<li>
						<a data-toggle="tab" href="#tab3">Blocks 3</a>
					</li>
				</ul>
				<!--Content-->
				<div class="tab-content" style="overflow: visible;">
					<!-- tab1 -->
					<div class="tab-pane active" id="tab1">
						<!--Thumbnail List-->
						<ul class="thumbnails">
							<li>
								<div class="thumbnail">
									<img src='data/coalore/1.png' id='picture' />
									<div class="caption">
										<h4>Coal Ore</h4>
										<select name="dpt" style="width: 100%;" onChange="document.getElementById('picture').src=this.options[this.selectedIndex].getAttribute('data-whichPicture');" >
											<option selected data-whichPicture='data/coalore/1.png' >Author 1</option>
											<option data-whichPicture='data/coalore/2.png' >Author 2</option>
											<option data-whichPicture='data/coalore/3.png' >Author 3</option>
											<option data-whichPicture='data/coalore/4.png' >Author 4</option>
										</select>
									</div>
								</div>
							</li>
							<li>
								<div class="thumbnail">
									<img src='data/ornatestonebrick/1.png' id='picture2' />
									<div class="caption">
										<h4>Ornate Stone Brick</h4>
										<select name="dpt" style="width: 100%;" onChange="document.getElementById('picture2').src=this.options[this.selectedIndex].getAttribute('data-whichPicture');" >
											<option selected data-whichPicture='data/ornatestonebrick/1.png' >Author 1</option>
											<option data-whichPicture='data/ornatestonebrick/2.png' >Author 2</option>
											<option data-whichPicture='data/ornatestonebrick/3.png' >Author 3</option>
											<option data-whichPicture='data/ornatestonebrick/4.png' >Author 4</option>
											<option data-whichPicture='data/ornatestonebrick/5.png' >Author 5</option>
										</select>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<!-- tab2 -->
					<div class="tab-pane" id="tab2">

					</div>
					<!-- tab3 -->
					<div class="tab-pane" id="tab3">

					</div>
				</div>

			</form>
		</div>
		<!--JavaScript-->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
	</body>
</html>

