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
            <form>
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
                    <option value="stickman">Stickman</option>
                    <option value="3d_stickman">3D Stickman</option>
                    <option value="bases_solides">Bases Solides</option>
                    <option value="presqu_artiste">Presqu'Artiste</option>
                    <option value="artiste">Artiste</option>
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
            <img src="logo.png" width="120" height="118">
        </footer>
    </body>
</html>