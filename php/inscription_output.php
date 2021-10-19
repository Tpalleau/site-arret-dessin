<?php
echo "enregistrement réussi";
$db = new PDO("mysql:host=localhost; dbname=dessin_bdd;charset=UTF8","root","");

$add_user = $db->prepare("insert into utilisateur(
                         email,
                         surnom,
                         nom,
                         prenom,
                         passwd
) values (?,?,?,?,?)");

$add_user->execute(
    [$_POST["texte_email"],
    $_POST["texte_surnom"],
    $_POST["texte_nom"],
    $_POST["texte_prenom"],
    $_POST["mdp"]]
);