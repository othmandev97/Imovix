<?php 
require_once('includes/config.php');
require_once('includes/classes/PreviewVideo.php');
require_once('includes/classes/CategoryContent.php');
require_once('includes/classes/EntityProvider.php');
require_once('includes/classes/Entity.php');
require_once('includes/classes/ErrorMessage.php');
require_once('includes/classes/SeasonProvider.php');
require_once('includes/classes/Season.php');
require_once('includes/classes/video.php');
require_once('includes/classes/VideoProvider.php');
require_once('includes/classes/User.php');

if(!isset($_SESSION["userLogin"])){ header("Location:signup.php"); } 

$userLogin= $_SESSION["userLogin"];
$userId= $_SESSION["id"];

$preveiw = new PreviewVideo($con,$userLogin);

// echo $preveiw->createPreviwVideo(null);

?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Imovies</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="assets/css/uikit.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="assets/plyr_videoPlayer/plyr.css">
  <link rel="stylesheet" href="assets/main.css">
</head>

<body>
