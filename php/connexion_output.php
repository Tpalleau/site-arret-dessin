<?php
session_start();

if ($_GET["connect"] == "true"){
    $db = new PDO("mysql:host=localhost; dbname=dessin_bdd;charset=UTF8","root","");
    $req_user = $db->prepare("select id from utilisateur where email=? and passwd=password(?)");
    $req_user->execute([$_POST["texte_email"], $_POST["mdp"]]);
    $user = $req_user->fetch();


    if ($user==NULL){
        header("Location: connexion.php?error=connexion");
    }else {
        $_SESSION["connected"] = true;
        header("Location: index.php");
    }
}else{
    $_SESSION["connected"]=false;
    header("location: index.php");
}