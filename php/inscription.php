<html lang="fr">
    <head>
        <title>Inscription</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>
            <h1> ARRET DESSIN </h1>
        </header>
        <nav>
            <form action="inscription_output.php" method="post">
                <label>
                    Nom : <input type="text" name="texte_nom" id="texte_nom" required="required">
                </label> <br/>
                <label>
                    Prenom : <input type="text" name="texte_prenom" id="texte_prenom" required="required">
                </label><br>
                <label>
                    Surnom : <input type="text" name="texte_surnom" id="texte_surnom" placeholder="surnom UTBM" required="required">
                </label><br>
                <label>
                    Email : <input type="email" name="texte_email" id="texte_email" placeholder="exemple@mail.fr" required="required">
                </label><br>
                <label for="niveau">Niveau de Dessin : </label>
                <select name="niveau" id="niveau">

                    <?php
                    $db = new PDO("mysql:host=localhost;dbname=dessin_bdd;charset=UTF8","root","");
                    $req_name_lvl = $db->prepare("select nom from nom_niv");
                    $req_name_lvl->execute();

                    while ($name = $req_name_lvl->fetch())
                        echo "<option value=" . $name["nom"] . ">" . $name["nom"] . "</option>";
                    ?>
                    
                </select><br>
                <label>
                    Date de Naissance : <input type="date" name="date_naissance" id="date_naissance" required="required">
                </label><br>
                <label>
                    Mot de Passe : <input type="password" name="mdp" id="mdp" required="required">
                </label><br>
                <label>
                    <input type="submit" value="S'inscrire">
                </label>
            </form>
        </nav>
        <footer>
            <p>Arret dessin </p>
            <img src="..\image\logo.png" width="120" height="118">
        </footer>
    </body>
</html>