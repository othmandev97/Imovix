<?php 
class ErrorMessage{
    public static function show($text){
        exit("<span class='uk-alert-danger uk-position-center uk-heading-medium' uk-alert><a class='uk-alert-close' uk-close></a>$text</span>");
    }
}

?>

