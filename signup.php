<?php //include_once('includes/db.php'); ?> 
<?php //include('includes/functions.php'); ?>
<?php //include('includes/functions.php'); ?>

<?php 
require_once('includes/config.php');
require_once('includes/functions.php');
require_once('includes/classes/FormSanitizer.php');
require_once('includes/classes/Constent.php');
require_once('includes/classes/Account.php');

        $account = new Account($con);
 
        if(isset($_POST['submit'])){

            $firstName=FormSanizier::sanitizeFormString($_POST['firstname']);
            $secondName=FormSanizier::sanitizeFormString($_POST['secondname']);
            $userName=FormSanizier::sanitizeFormName($_POST['username']);
            $email=FormSanizier::sanitizeFormEmail($_POST['email']);
            $password=FormSanizier::sanitizeFormPassword($_POST['password']);
            $password2=FormSanizier::sanitizeFormPassword($_POST['password2']);

            // echo  $firstName . '<br>' . $secondName . '<br>' . $userName . '<br>' . $email . '<br>' . $password ;
            $success = $account->register($firstName,$secondName,$userName,$email,$password,$password2);
            
            if($success){
                //!Store session
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
    <div class="uk-column-1-2 uk-column-1-2@s main_reg">

        <div class="sideImg">
            <img class="ImgReg" src="assets/images/siteFront/moviesSvg.svg" alt="">
            <div class="Reg"></div>
        </div>


        <div class="sidecontnts">
            <div class="sidecontnt">
                <h2 class="uk-heading-small">I MOVIX</h2>

                <h3>Welcome</h3>

                <form class="uk-form-stacked" action="" method="POST">

                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="firstname" type="text" placeholder="First Name" value="<?php getInputValue("firstname"); ?>" required>
                            <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$FirstNameChar)  ?> </label>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="secondname" type="text" placeholder="Last Name" value="<?php getInputValue("secondname"); ?>" required>
                            <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$LastNameChar)  ?> </label>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="username" type="text" placeholder="username" value="<?php getInputValue("username"); ?>" required>
                            <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$UserNameChar) ?> </label>
                            <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$UserNameTaken) ?> </label>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="email"  type="email" placeholder="Email Adresse" value="<?php getInputValue("email"); ?>" required>
                            <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$EmailValid) ?> </label>
                            <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$EmailTaken) ?> </label>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="password"  type="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" name="password2"  type="password" placeholder="confirm Password" required>
                            <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$PasswordMatch) ?> </label>
                            <label class="uk-alert-danger" for=""> <?php echo $account->getError(Constent::$Passwordlength) ?> </label>
                        </div>
                    </div>

                    <div class="uk-margin" uk-margin>
                        <input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" name="submit" value="Sign up">
                    </div>

                    <div class="uk-margin uk-flex uk-flex-center" uk-margin>
                        <a class="uk-link-muted" href="#">Forget Password?</a>           
                    </div>

                    <div class="uk-margin uk-flex uk-flex-center" uk-margin>
                        <a class="uk-link-muted" href="login.php">Login Here</a>          
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