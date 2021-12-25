<?php
try{
    $connection =new PDO("mysql:host=localhost;dbname=products","root","");
}
catch(PDOException $exception){
    echo $exception->getMessage();
}