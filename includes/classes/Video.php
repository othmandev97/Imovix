<?php
class Video{

    private $con, $input, $entity;

    public function __construct($con,$input){
       $this->con=$con;

       if(is_array($input)){
         $this->input=$input;   
       }else{
           $query=$this->con->prepare("SELECT * FROM videos WHERE id=:id");
           $query->bindValue(":id", $input);
           $query->execute();

           $this->input= $query->fetch(PDO::FETCH_ASSOC);
       }

       $this->entity = new Entity($con, $this->input["entityId"]);
 
    }

    public function getId(){
       return $this->input["id"];
    }

    public function getTitle(){
      return $this->input["title"];
    }

    public function getDescription(){
      return $this->input["description"];
    }

    public function getFilePath(){
      return $this->input["filePath"];
    }

    public function getThumbnail(){
      return $this->entity->getThumbnail();
    }
    
    public function getEpisodeNumber(){
      return $this->input["episode"];
    }

    public function getSeasonNumber(){
      return $this->input["season"];
    }

    public function getEntityId(){
      return $this->input["entityId"];
    }

    public function incrementViews(){
      $query=$this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
      $query->bindValue(":id",$this->getId());
      $query->execute();
    }

    public function getSeasonAndEpisode(){
      if($this->isMovie()){
        return;
      }

      $season= $this->getSeasonNumber();
      $episode= $this->getEpisodeNumber();


      return "Season $season,Episode $episode";
    }

    public function isMovie(){
      return $this->input["isMovie"] == 1;
    }

    public function seen($username){
      $query=$this->con->prepare("SELECT * FROM videoProgress WHERE videoId=:videoId AND username= :username
        AND progress > 0
      ");

      $query->bindValue(":videoId",$this->getId());
      $query->bindValue(":username",$username);
      $query->execute();

      return $query->rowCount() != 0;

    } 
 
}
?>