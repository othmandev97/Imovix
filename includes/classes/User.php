<?php  

class User {
    private $con,$sqldata;

    public function __construct($con,$email){
        $this->con=$con;

        $query=$con->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindValue(':email',$email);
        $query->execute();

        $this->sqldata= $query->fetch(PDO::FETCH_ASSOC);
    }


    public function getFirstName(){
        return $this->sqldata["firstName"];
    }

    public function getLastName(){
        return $this->sqldata["lastName"];
    }
    
    public function getUserName(){
        return $this->sqldata["username"];
    }

    public function getEmail(){
        return $this->sqldata["email"];
    }

    public function getIsSubscribed(){
        return $this->sqldata["isSubscribed"];
        // return true;
    }
    
    public function setIsSubscribed($value){
        $query=$this->con->prepare("UPDATE users SET isSubscribed=:isSubscribed Where username=:username");
        $query->bindValue(':isSubscribed',$value);
        $query->bindValue(':username',$this->getUserName());

        if($query->execute()){
            $this->sqldata["isSubscribed"] = $value;
            return true;
        }
        return false;
    }
}

?>