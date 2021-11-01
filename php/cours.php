<html lang="fr">
<?php
session_start();
?>
<head>
    <title>Index</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1> ARRET DESSIN </h1>
</header>
<nav>
    <div class="menu">
        <ul>
            <?php
            if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {
                ?>
                <li> <a href="inscription.php">S'Inscrire</a> </li>
                <li> <a href="connexion.php">Connexion</a> </li>
                <?php
            }else{ ?>
                <li> <a href="connexion_output.php?connect=false">deconnnexion</a> </li>

                <?php
            } ?>
            <li> <a href="cours.php">Cours</a> </li>
            <li> <a href="dessins.php">Dessins</a> </li>
            <li> <a href="demande.php">Demande au club</a> </li> <!-- demande materiel, cours ou autre -->
        </ul>
    </div>
</nav>
<div class="recherche_cours">
    <form>
        <h2>cours</h2>
        <label for="cour">cour : </label>
        <select name="cour" id="cour">
            <option value="">tout</option>

            <?php
            $db = new PDO("mysql:host=localhost;dbname=dessin_bdd;charset=UTF8","root","");
            $req_cour_nom = $db->prepare("select nom, id from nom_cours");
            $req_cour_nom->execute();

            while ($name = $req_cour_nom->fetch())
                echo "<option value=" . $name["id"] . ">" . $name["nom"] . "</option>";
            ?>

        </select>
        <label>
            date : <input type="date" name="date_cour" id="date_cour" value="*" min="<?= date('Y-m-d'); ?>">
        </label>

        <label for="heure_cour">heure </label>
        <select name="heure_cour" id="heure_cour">

            <option value=""> </option>
            <?php
            for ($heure=8; $heure<=18; ++$heure){
                if ($heure!=12){
                    echo "<option value=" . $heure . ">" . $heure . "h</option>";
                }
            }
            ?><br>

        </select><br>
        <label>
            <input type="submit" id="search" name="search" value="search" />
        </label>
    </form>
</div>
<?php
//cherche selon type cour date et jour
if (isset($_GET["search"])) {

    $prepare = "";

    $need_and = 0;
    if ($_GET["cour"] || $_GET["date_cour"] || $_GET["heure_cour"]) {//si une condition est demandé
        $prepare = $prepare . "where";//ajouter where
        if ($_GET["cour"]) {
            $prepare = $prepare . " nom=" . $_GET["cour"];
            $need_and = 1;
        }
        if ($_GET["date_cour"]) {
            if ($need_and) {//si condition avant celle ci
                $prepare = $prepare . " and ";
            }
            $need_and = 1;

            $prepare = $prepare . ' jour="' . $_GET["date_cour"] . '"';

        }
        if ($_GET["heure_cour"]) {
            if ($need_and) {//si condition avant celle ci
                $prepare = $prepare . " and ";
            }

            $prepare = $prepare . ' heure="' . $_GET["heure_cour"] . ':00:00"';
        } else {
            $time = "";
        }
    }
    //recup toute les infos sur ce cours
    $req_cour_info = $db->prepare("select id,nom ,salle,nb_place,jour,heure from cours " . $prepare);
    //recup le nom du cours
    $req_cour_nom = $db->prepare("select nom from nom_cours where id=?");
    //recup le nombre de participant
    $req_participant = $db->prepare("select count(utilisateur) as participe  from reservation where cours=?");

    $req_cour_info->execute();
    $cour_existe=[];

    while ($cour = $req_cour_info->fetch()) {
        $req_cour_nom->execute([$cour["nom"]]); //recup nom du cour
        $req_participant->execute([$cour["id"]]);

        $cour_nom = $req_cour_nom->fetch();
        $particpant = $req_participant->fetch();

        array_push($cour_existe, $cour["nom"]);

        //affiche nom/jour/heure/salle/nb participant/nb place
        echo $cour_nom["nom"]." ".$cour["jour"]." "
            .$cour["heure"]."H ".$cour["salle"]." ".$particpant["participe"].
            "/".$cour["nb_place"]."<br>";


    }
    //si root, (date et heure) specifier afiche cours que l'on peut ajouter
    if ($date=$_GET["date_cour"] && $heure=$_GET["heure_cour"] && isset($_SESSION["admin"])) {
        if ($cour_existe==[]){
            $req_cour_existe_pas = $db->prepare("select id from nom_cours");
        }else{
            $req_cour_existe_pas = $db->prepare("select id from nom_cours 
        where id not in (" . implode(",", $cour_existe) . ")");
        }

        $req_cour_existe_pas->execute();

        echo "<form>salle: <input type='text' name='salle' required='required'><br>";
        echo "nombre d'élève: <input type='number' name='nb_place' required='required'><br><br>";
        while ($cour = $req_cour_existe_pas->fetch()){
            $req_cour_nom->execute([$cour["id"]]);
            $cour_nom = $req_cour_nom->fetch();
            echo $cour_nom["nom"] . "   " . $_GET["date_cour"] . "   "
                . $_GET["heure_cour"] . "H";
            echo "<button type='submit' name='ajout_cour' value='".$cour["id"]."'>creer</button><br>";
        }
        echo "</form>";
    }
}

//ajout du cour
if (isset($_GET["ajout_cour"])){
            $req_ajout_cour=$db->prepare("insert into cours(nom, salle, nb_place, jour, heure)
 VALUES (? ,? ,? ,? ,?)");
            $req_ajout_cour->execute([$_GET["ajout_cour"],$_GET["salle"], $_GET["nb_place"], $date, $_GET["heure_cour"]]);

}
?>
<footer>
    <p>Arret dessin </p>
</footer>
</body>
</html>