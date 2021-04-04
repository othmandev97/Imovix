<?php 
class FormSanizier {

    public static function sanitizeFormString($tnptxt){
        $tnptxt = strip_tags($tnptxt);  //remove html tags
        //$tnptxt = str_replace(" ", "",$tnptxt);  //remove spaces in all the input
        $tnptxt = trim($tnptxt); //remove spaces from the last and first 
        $tnptxt = strtolower($tnptxt);
        $tnptxt = ucfirst($tnptxt); // make first char uppercase
        return $tnptxt;
    }

    public static function sanitizeFormName($tnptxt){
        $tnptxt = strip_tags($tnptxt);  //remove html tags
        $tnptxt = str_replace(" ", "",$tnptxt);  //remove spaces in all the input
        return $tnptxt;
    }

    public static function sanitizeFormPassword($tnptxt){
        $tnptxt = strip_tags($tnptxt);  //remove html tags
        $tnptxt = str_replace(" ", "",$tnptxt);  //remove spaces in all the input
        return $tnptxt;
    }

    public static function sanitizeFormEmail($tnptxt){
        $tnptxt = strip_tags($tnptxt);  //remove html tags
        $tnptxt = str_replace(" ", "",$tnptxt);  //remove spaces in all the input
        return $tnptxt;
    }

}

?>