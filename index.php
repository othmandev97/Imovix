<?php 

require_once('includes/header.php');

$preveiw = new PreviewVideo($con,$userLogin);

$previewVideoThumb = $preveiw->createPreviwVideo(null);  

 //$Video  = new Video($con,$previewVideoThumb);

?>

<!-- main section-->

<main class="main-section uk-clearfix" onload="privewPage();">

<!-- sidebar section-->

<?php include('includes/sidebar.php'); ?>

<!-- end sidebar section-->

<!-- home section-->

<div class="main uk-align-right">
	<div class="uk-position-relative">	

		<!-- navbar section-->
<?php include('includes/navbar.php'); ?>
       <!--end navbar section-->

	   	<!-- hero video section-->

		<div class="uk-cover-container uk-height-large overlay_video" uk-height-viewport="offset-bottom: 25">
		    <img src="<?php echo $previewVideoThumb[3]?>" alt="" class="previewimg" style="	width: 100%; height: 100%;" hidden>
			<video uk-video="autoplay: inview" src='<?php echo $previewVideoThumb[2]?>' class="previewvideo" playsinline uk-cover></video>
			<div class="uk-overlay-primary uk-position-cover"></div>
			<!-- <video src="" autoplay playsinline uk-video style="z-index:9999;"></video>  -->
		</div> 

<!-- home content section-->
	     	<article class="uk-article video-home_content">
			    <h1 class="uk-article-title "><?php echo $previewVideoThumb[1]?></h1>

			    <div class="uk-grid-small uk-child-width-auto" uk-grid>
			        <div>
			            <span class="uk-button uk-button-text" href="#">mystry</span>
			        </div>
			        <div>
			            <span class="uk-button uk-button-text" href="#"><?php echo $previewVideoThumb[5]?></span>
			        </div>
			    </div>

			    <p><?php echo $previewVideoThumb[6]?></p>

			    <div class="uk-grid-small uk-child-width-auto" uk-grid>
			        <div>
						<button onclick="playVideo(<?php echo $previewVideoThumb[4]?>)" id="btn_play" class="btn-home pulse"><i class="fas fa-play"></i>PLAY</button>
			        </div>
			        <div>
						<button id="btn_volume" class="btn-home close"><i class="fas fa-volume-up"></i></button>
			        </div>
			    </div>

			</article>
<!-- end home content section-->
	</div>

<!--********************************************************************** -->
	<!--videos section-->
		<?php
		$preveiwcategory = new CategoryContent($con,$userLogin);

		echo $preveiwcategory->showAllfunction();
		?>
	<!--videos section-->
<!--********************************************************************** -->

  
		<div class="uk-grid-match uk-grid-small uk-text-center uk-margin-large-top footer-section" uk-grid>
			<!-- <div class="uk-width-auto@m uk-visible@l">
				<div class="uk-card uk-card-primary uk-card-body">auto@m<br>visible@l</div>
			</div> -->
			<!-- <div class="uk-width-1-3@m">
				<div class="uk-card uk-card-default uk-card-body">1-3@m</div>
			</div> -->
			<div class="uk-width-expand@m">
				<div class="uk-card uk-card-default uk-card-body">Imovix &copy; All Right Reserved</div>
			</div>
		</div>


<!--end videos section-->
</div>

<!--end home section-->
</main>

<?php include_once('includes/footer.php');  ?>
