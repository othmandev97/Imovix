<?php 

require_once("../includes/config.php");


if(isset($_POST['id']) && isset($_POST['username'])){

    $query=$con->prepare('UPDATE videoProgress set finished=1, progress=0 WHERE username=:username AND videoId=:id');
    $query->bindValue(":username", $_POST['username']);
    $query->bindValue(":id", $_POST['id']);

    $query->execute();


}else{
    echo 'no video id or username passed';
}


?>