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

session_start();
if ($_SESSION['id']!='ADMIN')
{
    header("location:index.php");

}


$pseudo=$_REQUEST['id'];


// Cas 1ère étape (on vient de listeEtablissements.php)

if ($_REQUEST['action']=='demandervaliderListe')
{

  echo "
  <br><center><h5>Souhaitez-vous vraiment valider L'etablissement ?
  <br><br>
  <a href='validerListe.php?action=validerListeAtt&amp;id=$pseudo'>
  Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
  <a href='listeAttente.php?'>Non</a></h5></center>";



}else

{

  $request="INSERT INTO etablissement (id,nom,adresseRue,codePostal,ville,tel,adresseElectronique,type,civiliteResponsable,nomResponsable,prenomResponsable,nombreChambresOffertes,infosP,pass)
  SELECT pseudo,nom,adresseRue,codePostal, ville,tel,adresseElectronique,type, civiliteResponsable, nomResponsable,prenomResponsable,nombreChambresOffertes, infosP,mdp
  FROM Inscription WHERE pseudo='$pseudo'";
  $rsEtab=$connexion->query($request);
  $lgEtab = $rsEtab->fetch();

  supprimerListe($connexion, $pseudo);

  echo "
  <br><br><center><h5>L'établissement a été validé </h5>
  <a href='listeAttente.php?'>Retour</a></center>";
}

?>
