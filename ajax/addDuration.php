

<?php 

require_once("../includes/config.php");


if(isset($_POST['id']) && isset($_POST['username'])){
    $query=$con->prepare('SELECT * FROM videoProgress WHERE username=:username And videoId=:id');
    $query->bindValue(":username", $_POST['username']);
    $query->bindValue(":id", $_POST['id']);

    $query->execute();

    if($query->rowCount() == 0){
        $query=$con->prepare("INSERT INTO videoProgress (username,videoId) VALUES(:username,:id )");
        $query->bindValue(":username",$_POST['username']);
        $query->bindValue(":id",$_POST['id']);
        $query->execute();
    }

}else{
    echo 'no video id or username passed';
}


?>