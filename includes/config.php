<?php 
ob_start(); // turns on output buffering
session_start();

date_default_timezone_set("Africa/Casablanca");

    try{
        $con= new PDO("mysql:dbname=imovix;host=localhost", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }catch(PDOException $ex){
        exit("connection failed: " . $ex->getMessage());
    }


?>