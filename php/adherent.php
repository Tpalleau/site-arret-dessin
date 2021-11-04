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
                <li> <a href="connexion_output.php?connect=false">Deconnnexion</a> </li>

                <?php
            } ?>
            <li> <a href="cours.php">Cours</a> </li>
            <li> <a href="dessins.php">Dessins</a> </li>
            <li> <a href="demande.php">Demande au club</a> </li> <!-- demande materiel, cours ou autre -->
            <li> <a href="adherent.php">Recherche d'adhérent</a></li>
        </ul>
    </div>
</nav>
<div class="formulaire">
    <form>
        <h2>Recherche d'Adhérent</h2>
        <label>
            Nom : <input class="texte" type="text" name="texte_nom" id="texte_nom">
        </label>
        <label>
            Prénom : <input class="texte" type="text" name="texte_prenom" id="texte_prenom">
        </label><br>
        <label>
            Email : <input class="texte" type="email" name="texte_email" id="texte_email">
        </label>
        <label for="niveau">Niveau de Dessin : </label>
        <select name="niveau" id="niveau">

            <?php
            $db = new PDO("mysql:host=localhost;dbname=dessin_bdd;charset=UTF8","root","");
            $req_name_lvl = $db->prepare("select nom from nom_niv");
            $req_name_lvl->execute();

            while ($name = $req_name_lvl->fetch()) {
                echo "<option value=" . $name["nom"] . ">" . $name["nom"] . "</option>";
            }
            ?>

        </select><br>
        <label>
            <input class="submit" type="submit" value="Rechercher">
        </label>
    </form>
</div>
<footer>
    <p>Arret dessin </p>
</footer>
</body>
</html>