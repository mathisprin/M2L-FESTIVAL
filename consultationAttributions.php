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
if (empty($_SESSION['id']))
{
    header("location:index.php");

}
else
{
// CONSULTER LES ATTRIBUTIONS DE TOUS LES ÉTABLISSEMENTS

// IL FAUT QU'IL Y AIT AU MOINS UN ÉTABLISSEMENT OFFRANT DES CHAMBRES POUR
// AFFICHER LE LIEN VERS LA MODIFICATION
$nbEtab=obtenirNbEtabOffrantChambres($connexion);
if ($nbEtab!=0)
{


   // POUR CHAQUE ÉTABLISSEMENT : AFFICHAGE D'UN TABLEAU COMPORTANT 2 LIGNES
   // D'EN-TÊTE ET LE DÉTAIL DES ATTRIBUTIONS
   $iden=$_SESSION['id'];
   if ($_SESSION['id'] == 'ADMIN') {
     $req=obtenirReqEtablissementsAyantChambresAttribuées();
     $rsEtab=$connexion->query($req);
     $lgEtab= $rsEtab->fetch(PDO::FETCH_ASSOC);
     // BOUCLE SUR LES ÉTABLISSEMENTS AYANT DÉJÀ DES CHAMBRES ATTRIBUÉES
   }
   else
   {
     $req="select distinct id, nom, nombreChambresOffertes from Etablissement,
           Attribution where id = '$iden' order by id";
     $rsEtab = $connexion->query($req);
     $lgEtab = $rsEtab->fetch();
   }

   while($lgEtab!=FALSE)
   {
      $idEtab=$lgEtab['id'];
      $nomEtab=$lgEtab['nom'];

      echo "
      <table width='75%' cellspacing='0' cellpadding='0' align='center'
      class='thead-dark'>";

      $nbOffre=$lgEtab["nombreChambresOffertes"];
      $nbOccup=obtenirNbOccup($connexion, $idEtab);
      // Calcul du nombre de chambres libres dans l'établissement
      $nbChLib = $nbOffre - $nbOccup;

      // AFFICHAGE DE LA 1ÈRE LIGNE D'EN-TÊTE
      echo "
      <tr class='enTeteTabQuad'>
         <td colspan='3' align='left'><strong>$nomEtab</strong>&nbsp;
         (Offre : $nbOffre&nbsp;&nbsp;Disponibilités : $nbChLib)
         </td>
      </tr>";

      // AFFICHAGE DE LA 2ÈME LIGNE D'EN-TÊTE
      echo "
      <tr class='ligneTabQuad'>
         <td width='33%' align='left'><i><strong>Nom groupe</strong></i></td>
         <td width='33%' align='left'><i><strong>Nombre de Personne à loger</strong></i></td>
         <td width='33%' align='left'><i><strong>Chambres attribuées</strong></i>
         </td>
      </tr>";

      // AFFICHAGE DU DÉTAIL DES ATTRIBUTIONS : UNE LIGNE PAR GROUPE AFFECTÉ
      // DANS L'ÉTABLISSEMENT
      $req=obtenirReqGroupesEtab($idEtab);
      $rsGroupe=$connexion->query($req);
      $lgGroupe=$rsGroupe->fetch(PDO::FETCH_ASSOC);



      // BOUCLE SUR LES GROUPES (CHAQUE GROUPE EST AFFICHÉ EN LIGNE)
      while($lgGroupe!=FALSE)
      {
         $idGroupe=$lgGroupe['id'];
         $nomGroupe=$lgGroupe['nom'];
         $nbpersonne=$lgGroupe['nombrePersonnes'];
         echo "
         <tr class='ligneTabQuad'>
            <td width='33%' align='left'>$nomGroupe</td>";
         // On recherche si des chambres ont déjà été attribuées à ce groupe
         // dans l'établissement
         echo "
            <td width='33%' align='left'>$nbpersonne</td>";



         $nbOccupGroupe=obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe);

          
         echo "
            <td width='33%' align='left'>$nbOccupGroupe</td>
         </tr>";
         $lgGroupe=$rsGroupe->fetch(PDO::FETCH_ASSOC);

      } // Fin de la boucle sur les groupes

      echo "
      </table><br>";
      $lgEtab=$rsEtab->fetch(PDO::FETCH_ASSOC);
   } // Fin de la boucle sur les établissements
}
if ($_SESSION['id'] == 'ADMIN')
{
  echo "
    <div class='table-responsive'>
    <table width='75%' cellspacing='0' cellpadding='0' align='center'class='tabQuadrille'
    <tr><td>
    <a href='modificationAttributions.php?action=demanderModifAttrib' class ='btn btn-light'>
    Effectuer ou modifier les attributions</a></td></tr></table><br><br>";
}

}

?>
