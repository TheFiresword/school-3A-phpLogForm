<form action="page_inscription.php" method="POST">
    	<label for="pse">Pseudo:</label><input type="text" name="pseudo" id="pse" required="">
        <br><label for="mdp">Mot de passe:</label><input type="password" name="motdepasse" id="mdp" required=""><br>
        <label for="conf">Confirmation mot de passe:</label><input type="password" name="confirmationmotdepasse" required="" id="conf"><br>
        <label for="mail">Adresse email:</label><input type="email" name="email" id="mail" required=""><br>
        <input type="submit" name="valider" value="Valider">

  </form>