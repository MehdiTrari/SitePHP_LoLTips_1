<?php
require_once("header.php");
require_once("_navbar/navbar.php");

$req = $bdd->prepare("SELECT *
            FROM utilisateurs");

$req->execute();

$montab = $req->fetch();

if(isset($_SESSION['ID'])){
    $var = "Bonjour " . $montab['username'];
}else{
    $var = "bonjour à tous";
}

echo $var;


?>