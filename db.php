<?php
session_start();
$server="localhost";
$database="blog";
$user="root";
$password="";

$con=mysqli_connect($server,$user,$password,$database);

if(!$con){
    die('error :' .mysqli_connect_error());
}
?>