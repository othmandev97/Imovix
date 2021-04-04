<?php 
// get the input user and save it
        function getInputValue($name){
            if(isset($_POST[$name])){
                echo $_POST[$name];
            }
        }

?>

