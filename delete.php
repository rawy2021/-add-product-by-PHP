<?php
if(isset($_GET["id"])){
    include "connection.php";
    $id=$_GET["id"];
    $delete=$connection->prepare("DELETE FROM prudact Where id =?");
    $delete->execute([$id]);
    header("Location: index.php");
}else{
    header("Location: index.php");
}