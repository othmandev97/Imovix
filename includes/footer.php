
 
  <script src="assets/plyr_videoPlayer/plyr.js"></script> 
  <script src="assets/js/main.js"></script>
  <script src="assets/js/uikit.min.js"></script>
  <script src="assets/js/uikit-icons.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

<?php  if(basename($_SERVER['PHP_SELF']) == 'watch.php')  { ?>

  <script>
    initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLogin; ?>");
  </script> 

<?php  }  ?>

 
</body>
</html> 