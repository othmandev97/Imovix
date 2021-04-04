
<?php 
    class SearchResultProvider {
        private $con, $username;

        public function __construct($con, $username){
            $this->con=$con;
            $this->username=$username;
        }

        public function getResults($inputText){
            $entites= EntityProvider::getEntitiesSearch($this->con, $inputText);

            $html ="<div >";

            $html .= $this->getResultHtml($entites);
 

            return $html . " </div>";
        }

        private function getResultHtml($entites){
            
            if(sizeof($entites)==0){
                return;
            }

            $entitesHtml="";
            $PreviewVideo= new PreviewVideo($this->con,$this->username);

            foreach($entites as $entity){
                $entitesHtml .=$PreviewVideo->createEntityPreviewContent($entity);
            }

            return "

            <div class='uk-grid-column-small uk-grid-row-large uk-child-width-1-5@s uk-text-center' uk-grid>
               
                    $entitesHtml
               
            </div>
            
                
                ";
        }
        
    }

?>