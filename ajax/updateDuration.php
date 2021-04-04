<?php 

require_once("../includes/config.php");


if(isset($_POST['id']) && isset($_POST['username']) && isset($_POST['progress'])){

    $query=$con->prepare('UPDATE videoProgress set progress=:progress, dateModified=now() WHERE username=:username AND videoId=:id');
    $query->bindValue(":progress", $_POST['progress']);
    $query->bindValue(":username", $_POST['username']);
    $query->bindValue(":id", $_POST['id']);

    $query->execute();


}else{
    echo 'no video id or username passed';
}


?>