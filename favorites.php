<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Imovies</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="assets/css/uikit.css">
  <link rel="stylesheet" href="assets/main.css">

</head>

<body>

<!-- main section-->

<main class="main-section uk-clearfix">

<!-- sidebar section-->

<?php include('includes/sidebar.php'); ?>

<!-- end sidebar section-->

<!-- home section-->

<div class="main uk-align-right">
	<div class="uk-position-relative">	

		<!-- navbar section-->
		<?php include('includes/navbar.php'); ?>
       <!--end navbar section-->


<div class="uk-padding-large uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="clsActivated: uk-transition-active; center: true">

		<div class="uk-padding-large">
			<h3 class="uk-heading-bullet">Recent series</h3>
		</div>

			<div class="uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s uk-text-center" uk-grid>
			    <div>
			        <div class="uk-card uk-card-default uk-card-body">
						<img src="assets/images/1.jpg" alt="">
			        </div>
			    </div>
			    <div>
			        <div class="uk-card uk-card-default uk-card-body">
			        	<img src="assets/images/1.jpg" alt="">
			        </div>
			    </div>
			    <div>
			        <div class="uk-card uk-card-default uk-card-body">
			        	<img src="assets/images/1.jpg" alt="">
			        </div>
			    </div>
			    <div>
			        <div class="uk-card uk-card-default uk-card-body">
			        	<img src="assets/images/1.jpg" alt="">
			        </div>
			    </div>
			    <div>
			        <div class="uk-card uk-card-default uk-card-body">
			        	<img src="assets/images/1.jpg" alt="">
			        </div>
			    </div>
			    <div>
			        <div class="uk-card uk-card-default uk-card-body">
			        	<img src="assets/images/1.jpg" alt="">
			        </div>
			    </div>
			</div>

	</div>

<!--end videos section-->
</div>

<!--end home section-->



</main>




  <script src="js/scripts.js"></script>
  <script src="assets/js/uikit.min.js"></script>
  <script src="assets/js/uikit-icons.js"></script>
</body>
</html>