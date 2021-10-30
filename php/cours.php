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

        <label for="heur_cour">heure </label>
        <select name="heur_cour" id="heur_cour">

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
if (isset($_GET["search"])){

    $prepare = "";

    $need_and=0;
    if ($_GET["cour"] || $_GET["date_cour"] || $_GET["heur_cour"]){//si une condition est demandé
        $prepare=$prepare."where";//ajouter where
        if ($_GET["cour"]){
            $prepare=$prepare." nom=".$_GET["cour"];
            $need_and=1;
        }if ($_GET["date_cour"]){
            if ($need_and){//si condition avant celle ci
                $prepare=$prepare." and ";
            }
            $need_and=1;

            $prepare=$prepare.' jour="'.$_GET["date_cour"].'"';

        }if ($_GET["heur_cour"]){
            if ($need_and){//si condition avant celle ci
                $prepare=$prepare." and ";
            }

            $prepare=$prepare.' heur="'.$_GET["heur_cour"].':00:00"';
        }else{
            $time="";
        }
    }
    //recup le nom du cours
    $req_cour=$db->prepare("select nom from nom_cours where id=(select nom from cours ".$prepare.")");
    //recup toute les infos sur ce cours
    $req_cour_info=$db->prepare("select id,salle,nb_place,jour,heur from cours".$prepare);
    //recup le nombre de participant
    $req_participant=$db->prepare("select count(utilisateur) as participe from reservation where cours=?");

    $req_cour->execute();
    $req_cour_info->execute();

    while ($cour = $req_cour->fetch()){
        $cour_info=$req_cour_info->fetch();
        $req_participant->execute([$cour_info["id"]]);
        if (!($particpant = $req_participant->fetch())){
            $particpant["utilisateur"]=0;//si aucun utilisateur ne participe alors la veleur est 0
        }
        echo "<p>".$cour["nom"]."   ".$cour_info["jour"]."   "
            .$cour_info["heur"]."H   ".$cour_info["salle"]."   ".$particpant["participe"].
            "/".$cour_info["nb_place"]."</p><br>";
    }
}
?>
<footer>
    <p>Arret dessin </p>
</footer>
</body>
</html>