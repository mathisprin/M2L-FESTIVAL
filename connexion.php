<?php
session_start();
include("_debut.inc.php");
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival

$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Echec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}

echo "
	<form method='POST' action='connexion.php?'>
  	 <input type='hidden' value='validerConnexion' name='action'>
  	 <table width='85%' align='center' cellspacing='0' cellpadding='0' 
   	 class='tabNonQuadrille'>
   
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>Connexion</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Id*: </td>
         <td><input type='text' name='id' size ='10' 
         maxlength='8'></td>
      </tr>";
      echo '
      <tr class="ligneTabNonQuad">
         <td> mot de passe*: </td>
         <td><input type="password" name="motdepasse" size="30" 
         maxlength="45"></td>
      </tr>
	</table>';
echo "
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='center'><input type='submit' value='Valider' name='valider' id='submit'>
         </td>
      </tr>
   </table>
</form>";

if (isset($_POST['valider']))
{
	$reqId = "select motdepasse FROM admin WHERE id = :id";
   $req1 = $connexion->prepare($reqId); 
   $req1-> execute(array( 'id'=> $_POST['id']));
	$resultat = $req1->fetch()[0];

// TODO use password_verify 
	if (password_verify($_POST['motdepasse'], $resultat))
	{
		$_SESSION['id'] = $_POST['id'];
      echo "connecté";
		header('location:index.php');
	} 
	else
	 {
		echo "Il semble que votre identifiant ou votre mot de passe soient incorrects. Veuillez essayer à nouveau, s'il vous plaît";
	 }

}


?>