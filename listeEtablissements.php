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

// AFFICHER L'ENSEMBLE DES ÉTABLISSEMENTS
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// ÉTABLISSEMENT

echo "
<div class='table-responsive'>
   <table width='70%' cellspacing='0' cellpadding='0' align='center' 
   class='tabNonQuadrille'>
      <tr class='enTeteTabNonQuad'>
         <td colspan='4'>Etablissements</td>
      </tr>";

     
   
   /*$iden=$_SESSION['id'];
   //where id='$iden'
   $reqk="select id, nom from Etablissement  order by id"; 
   $rsEtab1 = $connexion->query($reqk);
   $lgEtab1 = $rsEtab1->fetch();*/
     
   $req = obtenirReqEtablissements();
   $rsEtab = $connexion->query($req);
   $lgEtab = $rsEtab->fetch();

 
   // BOUCLE SUR LES ÉTABLISSEMENTS
   while ($lgEtab!=FALSE)
   {
      $id=$lgEtab['id'];
      $nom=$lgEtab['nom'];
      echo "
		<tr class='ligneTabNonQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'> 
         <a href='detailEtablissement.php?id=$id' class ='btn btn-light'>
         Voir détail</a></td>
         
         <td width='16%' align='center'> 
         <a href='modificationEtablissement.php?action=demanderModifEtab&amp;id=$id' class ='btn btn-light'>
         Modifier</a></td>";
      	
         // S'il existe déjà des attributions pour l'établissement, il faudra
         // d'abord les supprimer avant de pouvoir supprimer l'établissement
			if (!existeAttributionsEtab($connexion, $id))
			{
            echo "
            <td width='16%' align='center'> 
            <a href='suppressionEtablissement.php?action=demanderSupprEtab&amp;id=$id' class ='btn btn-light'>
            Supprimer</a></td>";
         }
         else
         {
            echo "
            <td width='16%'>&nbsp; </td>";          
			}
			echo "
      </tr>";
      $lgEtab = $rsEtab->fetch();   

   } 
   echo "
   </table>
   <div class = 'middle'>
      <p><a href='creationEtablissement.php?action=demanderCreEtab' class ='btn btn-light'>Création d'un établissement</a></p>
   </div>";

}  
?>
