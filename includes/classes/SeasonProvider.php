<?php 
class SeasonProvider{
    private $con, $username;

    public function __construct($con,$username){
        $this->con=$con;
        $this->username=$username;
    }

    public function create($entity){
        $season= $entity->getSeasons();

        if(sizeof($season) == 0){
            return;
        }
        $seasonsHtml= "";
        foreach($season as $seas){
            $seasonsNumber=$seas->getSeasonNumber();

            $videosHtml="";
            foreach($seas->getVideos() as $videos){
                $videosHtml .=$this->createVideosquare($videos);
            }

            $seasonsHtml .="
            <div  class='uk-padding-small'>
             <h3 class='uk-heading-bullet season-header'>Season $seasonsNumber</h3>
                 <div class='uk-child-width-1-6@l uk-child-width-1-4@m uk-child-width-1-3@s uk-margin-small-left uk-margin-medium-right uk-margin-medium-bottom' uk-grid>
                     $videosHtml
                 </div>
            </div>";

        }

        return  $seasonsHtml;
    }


    private function createVideosquare($videos){
        $id = $videos->getId();
        $thumbnail = $videos->getThumbnail();
        $title = $videos->getTitle();  
        $description = $videos->getDescription();
        $episodeNumber = $videos->getEpisodeNumber();

        $shortDescription=substr($description,0,100);

        $hasSeen= $videos->seen($this->username) ? "barSeen" : "";


            $query=$this->con->prepare('SELECT progress from videoProgress WHERE username=:username AND videoId=:id');
            $query->bindValue(":username", $this->username);
            $query->bindValue(":id", $id);
        
            $query->execute();
        
            $progressVideo = $query->fetchColumn();

        return "
            <div>
            <div class='uk-card uk-card-default'> 
                    <a class='Item-link' href='watch.php?id=$id'>
                        <div class='Item' style='background-image:url($thumbnail);'>
                        <span class='$hasSeen uk-position-top' style=width:$progressVideo". 'rem'. "></span>
                            <div class='overlay'>
                                <div class='title'>$episodeNumber.$title</div>
                                    <div class='plot'>$shortDescription...</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div> ";
    }

}
?>