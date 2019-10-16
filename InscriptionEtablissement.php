<?php

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


// INSCRIPTION D'UN ÉTABLISSEMENT

// Déclaration du tableau des civilités
$tabCivilite=array("M.","Mme","Melle");


echo "
<form method='POST' action='InscriptionEtablissement.php?'>
   <input type='hidden' value='validerCreEtab' name='action'>
   <table width='85%' align='center' cellspacing='0' cellpadding='0'
   class='tabNonQuadrille'>

      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>Inscription établissement</td>
      </tr>";

      echo '
      <tr class="ligneTabNonQuad">
         <td> Login (8): </td>
         <td><input type="text" name="pseudo" size="50"
         maxlength="8"></td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Nom*: </td>
         <td><input type="text" name="nom" size="50"
         maxlength="45"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Adresse*: </td>
         <td><input type="text" name="adresseRue"
         size="50" maxlength="45"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Code postal*: </td>
         <td><input type="text" name="codePostal"
         size="4" maxlength="5"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Ville*: </td>
         <td><input type="text" name="ville" size="40"
         maxlength="35"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Téléphone*: </td>
         <td><input type="text" name="tel" size ="20"
         maxlength="10"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> E-mail: </td>
         <td><input type="text" name=
         "adresseElectronique" size ="75" maxlength="70"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Type*: </td>
         <td>';
                echo "
                <input type='radio' name='type' value='1'>
                Etablissement Scolaire
                <input type='radio' name='type' value='0' checked> Autre";
           echo "
           </td>
         </tr>
         <tr class='ligneTabNonQuad'>
            <td colspan='2' ><strong>Responsable:</strong></td>
         </tr>
         <tr class='ligneTabNonQuad'>
            <td> Civilité*: </td>
            <td> <select name='civiliteResponsable'>";
               for ($i=0; $i<3; $i=$i+1)
                  {
                     echo "<option selected>$tabCivilite[$i]</option>";
                  }
               echo '
               </select>&nbsp; &nbsp; &nbsp; &nbsp; Nom*:
               <input type="text" name=
               "nomResponsable" size="26" maxlength="25">
               &nbsp; &nbsp; &nbsp; &nbsp; Prénom:
               <input type="text" name=
               "prenomResponsable" size="26" maxlength="25">
            </td>
         </tr>
          <tr class="ligneTabNonQuad">
            <td> Nombre chambres offertes*: </td>
            <td><input type="text" name=
            "nombreChambresOffertes" size ="2" maxlength="3"></td>
         </tr>
         <tr class="ligneTabNonQuad">
            <td> Informations Pratiques: </td>
            <td><input type="text" name="infosP" size="100"
         maxlength="250"></td>
         </tr>
         <tr class="ligneTabNonQuad">
            <td> Mot de passe: </td>
            <td><input type="password" name="mdp" size="100"
         maxlength="250"></td>
         </tr>

   </table>';

   echo "
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'id='submit'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'id='submit'>
         </td>
      </tr>
      <tr>
         <td colspan='2' align='center'><a href='listeEtablissements.php'>Retour</a>
         </td>
      </tr>
   </table>
</form>";

// En cas de validation du formulaire : affichage des erreurs ou du message de
// confirmation





if (isset($_POST['valider']))
{
  $pseudo =$_POST['pseudo'];
  $nom = $_POST['nom'];
  $adresse = $_POST['adresseRue'];
  $cp = $_POST['codePostal'];
  $ville = $_POST['ville'];
  $tel = $_POST['tel'];
  $mail = $_POST['adresseElectronique'];
  $type = $_POST['type'];
  $civilite = $_POST['civiliteResponsable'];
  $nomResponsable =$_POST['nomResponsable'];
  $prenomResponsable = $_POST['prenomResponsable'];
  $chambres = $_POST['nombreChambresOffertes'];
  $infosP = $_POST['infosP'];
  $mdp = $_POST['mdp'];

  $hashpass = password_hash($mdp, PASSWORD_BCRYPT);

  if(!empty($pseudo) AND !empty($nom) AND !empty($adresse) AND !empty($cp) AND !empty($mail) AND !empty($chambres)  AND !empty($mdp))
    {
   $reqInscription = $connexion->prepare("INSERT INTO Inscription(pseudo,nom,adresseRue,codePostal,ville,tel,adresseElectronique,type,civiliteResponsable,nomResponsable,prenomResponsable,nombreChambresOffertes,infosP,mdp)
                                          VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
   $reqInscription->execute(array(
     $pseudo,
     $nom,
     $adresse,
     $cp,
     $ville,
     $tel,
     $mail,
     $type,
     $civilite,
     $nomResponsable,
     $prenomResponsable,
     $chambres,
     $infosP,
     $hashpass
   ));

    echo"Nous avons bien reçu vos informations";

  }else{
    echo "champs erronés/ veuillez renseigner tout les champs";
  }
}



/*if ($action=='validerCreEtab')
{
   if (nbErreurs()!=0)
   {
      afficherErreurs();
   }
   else
   {
      echo "
      <h5><center>La création de l'établissement a été effectuée</center></h5>";
   }
}*/

?>
