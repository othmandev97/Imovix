<?php 
require_once('includes/config.php');
require_once('includes/functions.php');
require_once('includes/classes/FormSanitizer.php');
require_once('includes/classes/Constent.php');
require_once('includes/classes/Account.php');

        $account = new Account($con);
 
        if(isset($_POST['submit'])){

            $email=FormSanizier::sanitizeFormEmail($_POST['email']);
            $password=FormSanizier::sanitizeFormPassword($_POST['password']);

            // echo  $firstName . '<br>' . $secondName . '<br>' . $userName . '<br>' . $email . '<br>' . $password ;
            $success = $account->login($email,$password);

            if($success){

                $sql="SELECT * FROM users WHERE email='".$email."' ";

                 $query=$con->prepare($sql);
                //  $query->bindValue(':em',$email);
                //  $query->bindValue(':pw',$password);

                 $query->execute();

                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION["id"]= $row['id'];

                }

                $_SESSION["userLogin"]=$email;

                header("Location: index.php");
               }
        }

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Imovies</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="assets/css/uikit.css">
  <link rel="stylesheet" href="assets/main.css">

</head>

<body>

<!-- main section-->


<!-- image section-->
    <div class="uk-column-1-2 main_reg">

        <div class="sideImg">
            <img  class="ImgReg" src="assets/images/siteFront/moviesSvg.svg" alt="">
            <div class="Reg"></div>
        </div>


        <div class="sidecontnts">
            <div class="sidecontnt">
                <h2 class="uk-heading-small">I MOVIX</h2>

                <h3>Welcome</h3>

                <form action="" method="POST" class="uk-form-stacked">

                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" name="email" id="form-stacked-email" type="email" placeholder="Email Adresse"  value="<?php getInputValue("email"); ?>" required>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" name="password" id="form-stacked-password" type="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="uk-margin" uk-margin>
                    <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$loginFailed)  ?> </label>
                    <input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" name="submit" value="Login">
                    </div>

                    <div class="uk-margin uk-flex uk-flex-center" uk-margin>
                        <a class="uk-link-muted" href="#">Forget Password?</a>           
                    </div>

                    <div class="uk-margin uk-flex uk-flex-center" uk-margin>
                        <a class="uk-link-muted" href="signup.php">Signup Here</a>          
                    </div>

                    

                </form>

            </div>
 
        </div>


    </div>





  <script src="js/scripts.js"></script>
  <script src="assets/js/uikit.min.js"></script>
  <script src="assets/js/uikit-icons.js"></script>
</body>
</html>