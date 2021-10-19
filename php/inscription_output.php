<?php
echo 'enregistrement réussi ' . $_POST["niveau"];
$db = new PDO("mysql:host=localhost; dbname=dessin_bdd;charset=UTF8","root","");

//$req_lvl_id = $db->prepare("select id from nom_niv where nom=?");
//$req_lvl_id->execute([$_POST["niveau"]]);
//$lvl = $req_lvl_id->fetch();
//echo $lvl;

$add_user = $db->prepare("insert into utilisateur(
                        email,
                        surnom,
                        nom,
                        prenom,
                        passwd,
                        naissance,
                        niv_dessin
) values (?,?,?,?,?,?, (select id from nom_niv where nom=?))");

$add_user->execute(
    [$_POST["texte_email"],
    $_POST["texte_surnom"],
    $_POST["texte_nom"],
    $_POST["texte_prenom"],
    password_hash($_POST["mdp"], PASSWORD_DEFAULT),
    $_POST["date_naissance"],
    $_POST["niveau"]]
);