<html lang="fr">
    <head>
        <title>Demande</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>
            <h1> ARRET DESSIN </h1>
        </header>
        <nav>
            <div>
                <ul>
                    <li> <a href="connexion.php">Connexion</a> </li> <!-- menu deroulant inscription ou se connecter -->
                        <ul>
                            <li> <a href="connexion.php">Se Connecter</a> </li>
                            <li> <a href="inscription.php">S'Inscrire</a> </li>
                        </ul>
                    <li> <a href="cours.php">Cours</a> </li>
                    <li> <a href="dessins.php">Dessins</a> </li>
                    <li> <a href="demande.php">Demande au club</a> </li> <!-- demande materiel, cours ou autre -->
                </ul>
                <br>
            </div>
            <p>Bienvenue dans ce formulaire d'envoie automatique d'email.</p>
            <p>Veuillez remplir les champs ci dessous et de bien choisir votre demande.</p>
            <form method="POST" action="envoie_mail.php">
                <label for="demande">Votre demande au club </label>
                <select name="demande" id="demande">
                    <option value="materiel">Demande de Materiel</option>
                    <option value="cours">Demande de Cours</option>
                    <option value="autre">Autres Demandes</option>
                </select><br>
                <label>
                    Votre message : <br>
                    <textarea name="message" rows="12" cols="40" required="required"></textarea>
                </label><br>
                <label>
                    Votre email : <input type="email" name="texte_email" id="texte_email" placeholder="exemple@mail.fr" required="required">
                </label><br>
                <input type="submit" value ="Envoyer">
            </form>
        </nav>
        <footer>
            <p>Arret dessin </p>
            <img src="logo.png" width="120" height="118">
        </footer>
    </body>
</html>