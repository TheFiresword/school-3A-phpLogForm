<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="tp_css.css">
	<title>Page d'inscription</title>
</head>
<body>
   
   <?php

    if(!isset($_POST['pseudo']))// Pseudo non envoyé, 1ère tentative d'inscription
    {
    
     include "formulaire.php";  
    }

    else
    {

     $bdd=new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$pseudo=htmlspecialchars($_POST['pseudo']);$motDePasse=htmlspecialchars($_POST['motdepasse']);$confirmation=htmlspecialchars($_POST['confirmationmotdepasse']);$email=htmlspecialchars($_POST['email']);

$req=$bdd->prepare('SELECT COUNT(pseudo) as counter FROM membres WHERE pseudo=:pseudo');
 $req->execute(array('pseudo'=>$pseudo));
 $ans=$req->fetch();

$statut=0;

if($confirmation!=$motDePasse || !preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || $ans['counter']!=0)
{
  if($confirmation!=$motDePasse)
  {
   $statut=-1;//mot de passe erronné 
   ?>
   <p>Erreur, les mots de passe ne correspondent pas<br> Veuillez réessayer<br></p>
   <?php 
  }

   if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
 {
  //email non valide
  $statut=-2;
  ?> <p>L'email est non valide<br> Veuillez réessayer</p>
  <?php  
 }
 

 if($ans['counter']!=0)
{
//Pseudo déja utilisé
  $statut=-3
  
?> <p>Pseudo déja pris<br> Veuillez réessayer</p>
  <?php
}
  
  include 'formulaire.php';
  
}



else
{
  //inscription valide

    $motDePasse=password_hash($motDePasse, PASSWORD_DEFAULT);

  $req_two=$bdd->prepare('INSERT INTO membres (pseudo,pass,email,inscription_date) VALUES (:pseudo,:pass,:email,:date_i)');
  $req_two->execute(array('pseudo'=>$pseudo,
              'pass'=>$motDePasse,
              'email'=>$email,
              'date_i'=>date('Y-m-d')
            ));
  header('Location: connexion.php');
}
    

    }

     ?>

  

</body>
</html>