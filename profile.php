<?php 

include_once('includes/header.php');
require_once('includes/paypalConfig.php');
include_once('includes/classes/Account.php');
include_once('includes/classes/FormSanitizer.php');
include_once('includes/classes/Constent.php');
include_once('includes/classes/BillingDetails.php');


$user = new User($con, $userLogin);
$detailsMsg="";
$detailsMsgPassword="";
$subscriptionMsg="";
//CHANGE USER DETAIL
if(isset($_POST["submituser"])){
    $account = new Account($con);

    $firstname = FormSanizier::sanitizeFormString($_POST["inpfname"]);
    $lastname = FormSanizier::sanitizeFormString($_POST["inlfname"]);
    $username = FormSanizier::sanitizeFormString($_POST["inpusername"]);
    $email = FormSanizier::sanitizeFormEmail($_POST["inpemail"]);

    $acc= $account->updateDetails($firstname, $lastname, $username, $email, $userId);

    if($acc){

        $detailsMsg= "
        <div class='uk-alert-success' uk-alert>
            <a class='uk-alert-close' uk-close></a>
            <p>Details updated successfuly.</p>
        </div>";

    }else{

        $errorMsg= $account->getErrorUpdate();
        
        $detailsMsg= "
        <div class='uk-alert-danger' uk-alert>
            <a class='uk-alert-close' uk-close></a>
            <p>$errorMsg </p>
        </div>";

        echo  $userId . '<br> ';

        
    }
    
}

//CHANGE PASSWORD
if(isset($_POST["submitNewPassword"])){
    $account = new Account($con);
    
    $oldpassword = FormSanizier::sanitizeFormPassword($_POST["oldpswd"]);
    $newPassword = FormSanizier::sanitizeFormPassword($_POST["newpswd"]);
    $confnewPassword = FormSanizier::sanitizeFormPassword($_POST["cnfnewpswd"]);
    
    $acc= $account->updatePassword($oldpassword, $newPassword, $confnewPassword, $userLogin);

    if($acc){

        $detailsMsgPassword= "
        <div class='uk-alert-success' uk-alert>
            <a class='uk-alert-close' uk-close></a>
            <p>Password updated successfuly.</p>
        </div>";

    }else{

        $errorMsgPassword= $account->getErrorUpdate();
        
        $detailsMsgPassword= "
        <div class='uk-alert-danger' uk-alert>
            <a class='uk-alert-close' uk-close></a>
            <p>$errorMsgPassword </p>
        </div>";

        echo  $userId . '<br> ';

        
    }
    
}

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $token = $_GET['token'];
    $agreement = new \PayPal\Api\Agreement();

    $subscriptionMsg= "
    <div class='uk-alert-danger' uk-alert>
        <a class='uk-alert-close' uk-close></a>
        <p>something went wrong..</p>
    </div>";

    try {
      // Execute agreement
      $agreement->execute($token, $apiContext);

      $result=BillingDetails::insertDetails($con, $agreement, $token, $userLogin);
      // update user account status
      $result=$result && $user->setIsSubscribed(1);

      if($result){
        $subscriptionMsg= "
        <div class='uk-alert-success' uk-alert>
            <a class='uk-alert-close' uk-close></a>
            <p>You're All Signed Up!.</p>
        </div>";
      }



    } catch (PayPal\Exception\PayPalConnectionException $ex) {
      echo $ex->getCode();
      echo $ex->getData();
      die($ex);
    } catch (Exception $ex) {
      die($ex);
    }
  } else if (isset($_GET['success']) && $_GET['success'] == 'false') {
    $subscriptionMsg= "
    <div class='uk-alert-danger' uk-alert>
        <a class='uk-alert-close' uk-close></a>
        <p>User Cancelled Or something went wrong.</p>
    </div>";
}


?>
<body class="body_profile">
    
        <header class="header_profile">
            <!-- navbar section-->
            <?php include('includes/navbar.php'); ?>        
        </header>
  

    <main class="main_profile" >
        <div class="content_profile">
            <div class="navigation">
                    <h3>Account setting</h3>
<?php 

    $username= isset($_POST["inpusername"]) ? $_POST["inpusername"] : $user->getUserName();
    $firstname= isset($_POST["inpfname"]) ? $_POST["inpfname"] : $user->getFirstName();
    $lastname= isset($_POST["inlfname"]) ? $_POST["inlfname"] : $user->getLastName();
    $email= isset($_POST["inpemail"]) ? $_POST["inpemail"] : $user->getEmail();
?>

                    <div class="uk-child-width-1-2@s" uk-grid>
                        <div>
                            <div uk-grid>
                                <div class="uk-width-auto@m">
                                    <ul class="uk-tab-left" uk-tab="connect: #component-tab-left; animation: uk-animation-fade">
                                        <li><a href="#">User</a></li>
                                        <li><a href="#">Update Password</a></li>
                                        <li><a href="#">Subscription</a></li>
                                    </ul>
                                </div>
                                <div class="uk-width-expand@m">
                                    <ul id="component-tab-left" class="uk-switcher">
                                        <li>
                                            <form action="" method="POST">
                                                <div class="uk-margin">
                                                  username :<input name="inpusername" class="uk-input uk-form-width-medium uk-form-small" type="text" value="<?php  echo $username; ?>">
                                                </div>
                                                <div class="uk-margin">
                                                  firstname :<input name="inpfname" class="uk-input uk-form-width-medium uk-form-small" type="text" value="<?php  echo $firstname; ?>">
                                                </div>
                                                <div class="uk-margin">
                                                  lastname :<input name="inlfname" class="uk-input uk-form-width-medium uk-form-small" type="text" value="<?php  echo $lastname; ?>">
                                                </div>
                                                <div class="uk-margin">
                                                  email :<input  name="inpemail" class="uk-input uk-form-width-medium uk-form-small" type="text" value="<?php  echo $email; ?>">
                                                </div>
                                                <div class="uk-margin">
                                                    <input class="uk-input uk-button profile_submit" type="submit" name="submituser" value="Save">
                                                </div>
                                               <?php echo $detailsMsg ?>
                                            </form>
                                        </li>
                                        <li>                              
                                            <form action="" method="POST">
                                                <div class="uk-margin">
                                                    <input name="oldpswd" class="uk-input uk-form-width-medium uk-form-small" type="password" placeholder="old password">
                                                </div>
                                                <div class="uk-margin">
                                                    <input name="newpswd" class="uk-input uk-form-width-medium uk-form-small" type="password" placeholder="new password">
                                                </div>
                                                <div class="uk-margin">
                                                    <input name="cnfnewpswd" class="uk-input uk-form-width-medium uk-form-small" type="password" placeholder="confirm new password">
                                                </div>
                                                <div class="uk-margin">
                                                    <input class="uk-input uk-button profile_submit" type="submit" name="submitNewPassword" value="Save">
                                                </div>
                                                <?php echo $detailsMsgPassword ?>
                                            </form>
                                        </li>
                                        <li>
                                            <h2 class="subscription_header">Subscription</h2>
                                            <?php echo $subscriptionMsg ?>
                                            <?php 
                                            if($user->getIsSubscribed()){
                                                echo "<h3>You Are Subcribed. You Can Cancel Any Time By Going TO Your Paypal Account.</h3>";
                                            }else {
                                                echo "<h3><a class='subscription_link' href='billing.php'>Subscibe To Imovix</a></h3>";
                                            }             
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <div>
            </div>


        </div>
    </main>


</body>
<?php 

include_once('includes/footer.php');

?>