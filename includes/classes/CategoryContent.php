<?php 
class CategoryContent{

    private $con;
    private $username;

    public function __construct($con,$username){
        $this->con=$con;
        $this->username=$username;
    }
    //ALL
    public function showAllfunction(){

        $query=$this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html= "<div>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            
            $html .=$this->getCategoryHtml($row, null, true, true);

        }
        return $html .  "</div>";
    }

        //ALL
        public function showCategory($categoryId, $title = null){

            $query=$this->con->prepare("SELECT * FROM categories WHERE id=:id");
            $query->bindValue(":id",$categoryId);
            $query->execute();
    
            $html= "<div>";
    
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                
                $html .=$this->getCategoryHtml($row, $title, true, true);
    
            }
            return $html .  "</div>";
        }

    //SERIES
    public function showAllTvShowCategories(){

        $query=$this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html= "<div>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            
            $html .=$this->getCategoryHtml($row, null, true, false);

        }
        return $html .  "</div>";
    }

   //MOVIES 
    public function showAllMoviesCategories(){

        $query=$this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html= "<div>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            
            $html .=$this->getCategoryHtml($row, null, false, true);

        }
        return $html .  "</div>";
    }


    private function getCategoryHtml($sqldata,$title,$tvShows,$movies){
        $categoryId=$sqldata["id"];
        $title = $title == null ? $sqldata["name"] : $title;

        if($tvShows && $movies){

            $entites=EntityProvider::getEntities($this->con,$categoryId,50);

        }else if($tvShows ){
            //get tv show entites
            $entites=EntityProvider::getEntitiesTv($this->con,$categoryId,50);
        }else{
            //get movies entites
            $entites=EntityProvider::getEntitiesMovies($this->con,$categoryId,50);
        }

        if(sizeof($entites)==0){ 
            return;
        }

        $entitesHtml="";
        $PreviewVideo= new PreviewVideo($this->con,$this->username);

        foreach($entites as $entity){
            $entitesHtml .=$PreviewVideo->createEntityPreviewContent($entity);
        }

        return "
        
            <div class='uk-position-relative uk-visible-toggle uk-light section-movies' tabindex='-1' uk-slider='center:false; clsActivated: uk-transition-active;'>
                    <div  class='uk-padding-small'>
                        <h3 class='uk-heading-bullet'><a href='category.php?id=$categoryId'>$title</a></h3>
                    </div>

                   
	             <ul class='uk-slider-items uk-grid'  style='padding-top: 2rem ;' >  
                   $entitesHtml        
                </ul>

                <a class='uk-position-center-left uk-position-small uk-hidden-hover' href='#' uk-slidenav-previous uk-slider-item='previous'></a>
                <a class='uk-position-center-right uk-position-small uk-hidden-hover' href='#' uk-slidenav-next uk-slider-item='next'></a>
            </div>
            
           
            
            ";

    }

}
?>
