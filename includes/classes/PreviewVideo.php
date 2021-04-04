<?php 
class PreviewVideo{

    private $con;
    private $username;

    public function __construct($con,$username){
        $this->con=$con;
        $this->username=$username;
    }

    //SERIES
    public function tvShowPreview(){
        $entitiesArray = EntityProvider::getEntitiesTv($this->con,null,1);


        if(sizeof($entitiesArray) == 0){
            ErrorMessage::show("NO TV SHOWS TO DISPLAY!");
        }

        return $this->createPreviwVideo($entitiesArray[0]);

    }

    //MOVIES 
    public function moviesPreview(){
        $entitiesArray = EntityProvider::getEntitiesMovies($this->con,null,1);


        if(sizeof($entitiesArray) == 0){
            ErrorMessage::show("NO MOVIES TO DISPLAY!");
        }

        return $this->createPreviwVideo($entitiesArray[0]);

    }

    //CATEGORIES
    public function categoriesPreview($catId){
    $entitiesArray = EntityProvider::getEntities($this->con, $catId, 1);


    if(sizeof($entitiesArray) == 0){
        ErrorMessage::show("NO CATEGORY TO DISPLAY!");
    }

    return $this->createPreviwVideo($entitiesArray[0]);

    }
    
    //ALL

    public function createPreviwVideo($entity){
        
        if($entity == null){
           $entity=$this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $preview=$entity->getPreview();
        $thumbnail=$entity->getThumbnail();

        $videoId = VideoProvider::getEnityVideo($this->con, $id, $this->username);

        $videoInfo = new Video($this->con, $videoId); 
        $seasonEpisode = $videoInfo->getSeasonAndEpisode();
        $discription=$videoInfo->getDescription();
        $subheading=$videoInfo->isMovie() ? "" : "$seasonEpisode";
        $videoInfo->getTitle();

     return  $arrayvideo = array("$id", "$name", "$preview", "$thumbnail","$videoId","$subheading","$discription");

    //   return "<video src='$preview' offset='50' autoplay loop muted playsinline uk-cover></video>";

    }

    public function createEntityPreviewContent($entity){
        $id=$entity->getId();
        $thumbnail=$entity->getthumbnail();
        $Name=$entity->getName();
        
        return "
        <div>

            <div class='uk-card uk-card-default'>

                <li class='uk-child-width-1-3@m'>  
                    <div class='uk-panel'>
                            <div class='uk-card uk-card-default'>
                                <div class='Item' style='background-image:url($thumbnail);'>
                                    <div class='overlay'>
                                        <a class='Item-link' href='entity.php?id=$id'> <div class='title'>$Name</div></a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </li>

            </div>

        </div>

        "; 
    }

    private function getRandomEntity(){
        $query=$this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();

        $row= $query->fetch(PDO::FETCH_ASSOC);
        
        return new Entity($this->con, $row);
    }

}


?>