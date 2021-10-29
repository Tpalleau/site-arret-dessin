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
            <option value="*">tout</option>

            <?php
            $db = new PDO("mysql:host=localhost;dbname=dessin_bdd;charset=UTF8","root","");
            $req_cour_nom = $db->prepare("select nom, id from nom_cours");
            $req_cour_nom->execute();

            while ($name = $req_cour_nom->fetch())
                echo "<option value=" . $name["id"] . ">" . $name["nom"] . "</option>";
            ?>

        </select>
        <label>
            date : <input type="date" name="date_cour" id="date_cour" required="required" min="<?= date('Y-m-d'); ?>">
        </label>

        <label for="time">heure </label>
        <select name="time" id="time">

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
    $req_cour_nom->execute();
    $req_cour_size = $db->prepare("select nb_place from cours where nom=?");

    while ($name = $req_cour_nom->fetch()) {
        //recup de la taille selon le cour
            $req_cour_size->execute([$name["id"]]);

            //si des utilisateurs se sont déjà inscrit au cours
            if ($size = $req_cour_size->fetch()) {
                echo "<p>" . $name["nom"] . $size["nb_place"] . "/25 participant</p>";
            }else{ //si aucun utilisateurs n'est inscrit
                echo "<p>" . $name["nom"] ." 0/25 participant</p>";
            }
    }
}
?>
<footer>
    <p>Arret dessin </p>
</footer>
</body>
</html>