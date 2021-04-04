<?php 

require_once("../includes/config.php");
require_once("../includes/classes/SearchResultProvider.php");
require_once("../includes/classes/EntityProvider.php");
require_once("../includes/classes/Entity.php");
require_once("../includes/classes/PreviewVideo.php");


if(isset($_POST['term']) && isset($_POST['username'])){

    $searchResult =new SearchResultProvider($con, $_POST['username']);
    echo $searchResult->getResults($_POST['term']);

}else{
    echo 'no term id or username passed';
}


?>