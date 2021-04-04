<?php 

require_once("../includes/config.php");


if(isset($_POST['id']) && isset($_POST['username'])){

    $query=$con->prepare('SELECT progress from videoProgress WHERE username=:username AND videoId=:id');
    $query->bindValue(":username", $_POST['username']);
    $query->bindValue(":id", $_POST['id']);

    $query->execute();

    echo $query->fetchColumn();

}else{
    echo 'no video id or username passed';
}


?>