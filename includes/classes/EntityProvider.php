<?php 
    class EntityProvider{

        public static function getEntities($con,$categroyId,$limit){
            $sql="SELECT * FROM entities ";

            if($categroyId != null){
                $sql .="WHERE categoryId =:categroyId ";

            }

            $sql .="ORDER BY RAND() LIMIT :limit"; 

                $query=$con->prepare($sql);

                if($categroyId != null){
                    $query->bindValue(":categroyId",$categroyId);
                }

                $query->bindValue(":limit",$limit,PDO::PARAM_INT);
                $query->execute();

                $result =array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $result []=new Entity($con,$row);
                }


                return $result;

        }


        public static function getEntitiesTv($con,$categroyId,$limit){
            $sql=" SELECT DISTINCT(entities.id) FROM entities 
            INNER JOIN videos on entities.id = videos.entityId  
            WHERE videos.isMovie = 0 ";

            if($categroyId != null){
                $sql .="AND categoryId =:categroyId ";

            }

            $sql .="ORDER BY RAND() LIMIT :limit"; 

                $query=$con->prepare($sql);

                if($categroyId != null){
                    $query->bindValue(":categroyId",$categroyId);
                }

                $query->bindValue(":limit",$limit,PDO::PARAM_INT);
                $query->execute();

                $result =array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $result []=new Entity($con,$row["id"]);
                }


                return $result;

        }

        public static function getEntitiesMovies($con,$categroyId,$limit){
            $sql=" SELECT DISTINCT(entities.id) FROM entities 
            INNER JOIN videos on entities.id = videos.entityId  
            WHERE videos.isMovie = 1 ";

            if($categroyId != null){
                $sql .="AND categoryId =:categroyId ";

            }

            $sql .="ORDER BY RAND() LIMIT :limit"; 

                $query=$con->prepare($sql);

                if($categroyId != null){
                    $query->bindValue(":categroyId",$categroyId);
                }

                $query->bindValue(":limit",$limit,PDO::PARAM_INT);
                $query->execute();

                $result =array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $result []=new Entity($con,$row["id"]);
                }


                return $result;

        }
        //SEARCH ¨ PAGE ¨ 
        public static function getEntitiesSearch($con,$term){
            $sql="SELECT * FROM entities WHERE name LIKE CONCAT('%', :term, '%') LIMIT 30";

                $query=$con->prepare($sql);

                $query->bindValue(":term",$term);
                $query->execute();

                $result =array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $result []=new Entity($con,$row);
                }


                return $result;

        }


    }

?>