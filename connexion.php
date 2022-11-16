<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Page de connexion</title>
</head>
<body>

	<?php 

    if(!isset($_POST['pseudo']))
    {

    	include "formulaire_connex.php";
    }
     else
    {

     $bdd=new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$pseudo=htmlspecialchars($_POST['pseudo']);$motDePasse=htmlspecialchars($_POST['motdepasse']);

$req=$bdd->prepare('SELECT COUNT(pseudo) as counter FROM membres WHERE pseudo=:pseudo');
 $req->execute(array('pseudo'=>$pseudo));
 $ans=$req->fetch();

   if($ans['counter']==0)// Pseudo n'existe pas, erreur
   {
    ?>
    <p>Les identifiants rentrés ne correspondent pas</p>
    <?php
    include "formulaire_connex.php";
   }

   else// Le pseudo existe, on récupère son mot de passe
   {
   	$req=$bdd->prepare('SELECT id, pass FROM membres WHERE pseudo=:pseudo');
 $req->execute(array('pseudo'=>$pseudo));
 $ans=$req->fetch();

 $realPass=$ans['pass'];
 if(!password_verify($motDePasse, $realPass))// Mot de passe incorrect
 {
  ?>
    <p>Le mot de passe rentré ne correspond à aucun compte</p>
    <?php
    include "formulaire_connex.php";

 }
 else// Tout est correct
 {
 //Checké la connexion automatique, créer une session au cas ou
  echo "Vous etes connectés";
 }
   }
  

    } 


	 ?>

</body>
</html>