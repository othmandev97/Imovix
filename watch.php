<?php 
require_once('includes/header.php');

if(!isset($_GET["id"])){
    ErrorMessage::show("no ID passed in the url"); 
}


  $video = new Video($con, $_GET["id"]);
  $video->incrementViews();


  $nextVideo  = VideoProvider::getUpnext($con,$video);

?>


<div class="uk-position-top-center uk-container-large" id="playerVideo">
   <div class="">
      <button class="btn_transprt" onclick="goBack()"><span uk-icon="icon: arrow-left; ratio: 3"></span><?php echo $video->getTitle(); ?></button>  
   </div>

   <div class="uk-position-center uk-flex uk-flex-middle refrechDiv" style="z-index:999;display:none">
    <button onclick="restartVideo()"><span uk-icon="icon: refresh; ratio: 3"></span></button>
      <div class="upnext">
          <h3><b>NEXT:</b> <?php echo  $nextVideo->getTitle(); ?></h3> 
          <h3><?php echo  $nextVideo->getSeasonAndEpisode(); ?></h3>
          <button onclick="playVideo(<?php echo  $nextVideo->getId(); ?>)"><span uk-icon="icon: play-circle; ratio: 3"></span>PLAY</button>
      </div>
   </div>
  
    <video oneded="EndedVideo()" id="player" autoplay playsinline controls data-poster="/path/to/poster.jpg" style="--plyr-color-main: #E7B3B3;" >
      <source src="<?php echo $video->getFilePath(); ?>" type="video/mp4" />
      <!-- <source src="/path/to/video.webm" type="video/webm" /> -->
    </video>

</div>


<?php include_once('includes/footer.php');?>
