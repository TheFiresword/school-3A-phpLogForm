<form action="connexion.php" method="POST">
    	<label for="pse">Pseudo:</label><input type="text" name="pseudo" id="pse" required="">
        <br><label for="mdp">Mot de passe:</label><input type="password" name="motdepasse" id="mdp" required=""><br>
        <label for="auto">Connexion automatique:</label><input type="checkbox" name="automatique" id="auto" checked="" ><br>
        <input type="submit" name="valider" value="Valider">

  </form>