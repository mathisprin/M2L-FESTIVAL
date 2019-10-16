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
else
{
// SUPPRIMER UN ÉTABLISSEMENT

$pseudo=$_REQUEST['id'];

$req="select * from Inscription where pseudo='$pseudo'";
$rsEtab=$connexion->query($req);
$lgEtab = $rsEtab->fetch();

$nom=$lgEtab['nom'];

// Cas 1ère étape (on vient de listeEtablissements.php)

if ($_REQUEST['action']=='demanderSupprListe')
{
   echo "
   <br><center><h5>Souhaitez-vous vraiment supprimer l'établissement $nom ?
   <br><br>
   <a href='SupprListe.php?action=validerSupprListe&amp;id=$pseudo'>
   Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
   <a href='listeAttente.php?'>Non</a></h5></center>";
}

// Cas 2ème étape (on vient de suppressionEtablissement.php)

else
{
   supprimerListe($connexion, $pseudo);
   echo "
   <br><br><center><h5>L'établissement $nom a été supprimé</h5>
   <a href='listeAttente.php?'>Retour</a></center>";
}
}
?>
