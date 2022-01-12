<?php


require "db.php";


$id=$_GET['id'];
$sql ="SELECT  * FROM blogs WHERE `id` =$id";
$data=mysqli_query($con,$sql);

if(mysqli_num_rows($data)==1){
    $sql ="DELETE  FROM blogs WHERE `id` =$id";
    $op=mysqli_query($con,$sql);
    if($op){
        $message="Row deleted";
    } else{
        $message="error msg try agin";
    }


}else{
    $message="invalid id";
}

$_SESSION['message']=$message;


header("location: index.php");

?>