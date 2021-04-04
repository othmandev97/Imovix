<?php 

class Account{

    private $con;
    private $errorArray= array();

    public function __construct($con){
        $this->con=$con;
    }

    public function register($fn, $ln, $us, $em, $pw, $pw2){
       $this->validateFirstName($fn);
       $this->validatelastName($ln);
       $this->validateUsername($us);
       $this->validateEmail($em);
       $this->validatePassword($pw,$pw2);

       if(empty($this->errorArray)){
          return $this->InsertUserDetails($fn, $ln, $us, $em, $pw);
       }
        
       return false;
    }


    public function login($em, $pw){
        $pw=hash("sha512", $pw);

        $query= $this->con->prepare("SELECT * FROM users WHERE email=:ma AND password=:pass");
        $query->bindValue(":ma", $em);
        $query->bindValue(":pass", $pw);
 
        $query->execute();

        if($query->rowCount() == 1){
            return $pw;
        }

        array_push($this->errorArray,Constent::$loginFailed);
        return false;
    }

    private function InsertUserDetails($fn, $ln, $us, $em, $pw){
        
        $pw=hash("sha512", $pw);

        $query=$this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password)
                                       VALUES (:fn, :ln, :us, :em, :pw)");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":us", $us);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        return $query->execute();
        /*
        $query->execute();
        var_dump($query->errorInfo());
        */
    }

    public function updateDetails($fn,$sn,$usn,$em,$id){

        $this->validateFirstName($fn);
        $this->validatelastName($sn);
        $this->validateEmailSub($em,$id);

        if(empty($this->errorArray)){
           
            $query=$this->con->prepare("UPDATE users SET firstName=:fn, lastName=:sn, username=:usn WHERE email=:em");
            $query->bindValue(':fn', $fn);
            $query->bindValue(':sn', $sn);
            $query->bindValue(':usn', $usn);
            $query->bindValue(':em', $em);

            return $query->execute();
        }

        return false;
    }

    public function updatePassword($oldPsw,$pw,$pw2,$em){

        $this->validOldPassword($oldPsw,$em);
        $this->validatePassword($pw,$pw2);

        if(empty($this->errorArray)){
           
            $query=$this->con->prepare("UPDATE users SET password=:pw WHERE email=:em");
            $pw=hash("sha512", $pw);
            $query->bindValue(':pw', $pw);
            $query->bindValue(':em', $em);

            return $query->execute();
        }

        return false;
    }

    public function validOldPassword($oldPsw,$em){
        $pw=hash("sha512", $oldPsw);

        $query= $this->con->prepare("SELECT * FROM users WHERE email=:ma AND password=:pass");
        $query->bindValue(":ma", $em);
        $query->bindValue(":pass", $oldPsw);
 
        $query->execute();

        if($query->rowCount() == 0){
            array_push($this->errorArray, Constent::$Passwordincorrect);
        }
    }

    private function validateFirstName($fn){
      if(strlen($fn) < 2 ||  strlen($fn) > 25){
        array_push($this->errorArray, Constent::$FirstNameChar);
      }
    }


    private function validatelastName($ln){
        if(strlen($ln) < 2 ||  strlen($ln) > 25){
          array_push($this->errorArray, Constent::$LastNameChar);
        }
    }

    private function validateUsername($us){
        if(strlen($us) < 2 ||  strlen($us) > 25){
          array_push($this->errorArray, Constent::$UserNameChar);
          return;
        }

        $query= $this->con->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un",$us);

        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray,Constent::$UserNameTaken);
        }
    }

    private function validateEmail($em){

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constent::$EmailValid);
            return;
        }

        $query= $this->con->prepare("SELECT * FROM users WHERE email=:un");
        $query->bindValue(":un",$em);

        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray,Constent::$EmailTaken);
        }
    }

    private function validateEmailSub($em,$id){

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constent::$EmailValid);
            return;
        }

        $query= $this->con->prepare("SELECT * FROM users WHERE email=:em AND id !=:id ");
        $query->bindValue(":em",$em);
        $query->bindValue(":id",$id);

        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray,Constent::$EmailTaken);
        }
    }

    private function validatePassword($pw,$pw2){
        if(strlen($pw) < 2 ||  strlen($pw) > 25){
            array_push($this->errorArray, Constent::$Passwordlength);
            return;
        }

        if($pw != $pw2){
          array_push($this->errorArray, Constent::$PasswordMatch);
        }
    }

    public function getError($error){
       if(in_array($error, $this->errorArray)){
           return $error;
       }
    }

    public function getErrorUpdate(){
        if(!empty($this->errorArray)){
            return $this->errorArray[0];
        }
    }
}

?>