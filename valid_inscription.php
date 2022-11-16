
<?php

$bdd=new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$pseudo=htmlspecialchars($_POST['pseudo']);$motDePasse=htmlspecialchars($_POST['motdepasse']);$confirmation=htmlspecialchars($_POST['confirmationmotdepasse']);$email=htmlspecialchars($_POST['email']);

$statut=0;

if($confirmation!=$motDePasse)
{
 //mot de passe erronné 
	$statut=-1;

}


 if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
 {
  //email non valide
 	$statut=-2;
 }


 $req=$bdd->prepare('SELECT COUNT(pseudo) as counter FROM membres WHERE pseudo=:pseudo');
 $req->execute(array('pseudo'=>$pseudo));
 $ans=$req->fetch();


 if($ans['counter']!=0)
{
//Pseudo déja utilisé
	$statut=-3
}

if($confirmation==$motDePasse && $ans['counter']==0 && $confirmation==$motDePasse)
{
  //inscription valide

    $motDePasse=password_hash($motDePasse, PASSWORD_DEFAULT);

	$req_two=$bdd->prepare('INSERT INTO membres (pseudo,pass,email,inscription_date) VALUES (:pseudo,:pass,:email,:date_i)');
	$req_two->execute(array('pseudo'=>$pseudo,
							'pass'=>$motDePasse,
							'email'=>$email,
							'date_i'=>date('Y-m-d')
						));


}

 ?>
<form action="page_inscription.php" method="POST">
	 <input type="hidden" name="statut" value="<?php echo $statut?>">	
</form>
<?php header('Location:page_inscription.php'); ?>
