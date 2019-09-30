<?php

?>
<!DOCTYPE html>   
<!-- TITRE ET MENUS -->
<html lang="fr">
<head>
<title>Festival</title>
<meta http-equiv="Content-Language" content="fr">
<meta charset="utf-8">
<link href="css/cssGeneral.css" rel="stylesheet" type="text/css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body class="basePage">

<!--  Tableau contenant le titre -->
   <div class=head>
      <p class="titre">Maison des Ligues <br> 
      </p>
      <p class="sous_titre"> H&eacute;bergement des groupes</p>
   </div>
<!--<table width="100%" cellpadding="0" cellspacing="0">
   <tr> 
      <td class="titre">Maison des Ligues <br>
      <span id="texteNiveau2" class="texteNiveau2">
      H&eacute;bergement des groupes</span><br>&nbsp;
      </td>
   </tr>
</table>-->

<!--  Tableau contenant les menus -->
<!--
<table width="80%" cellpadding="0" cellspacing="0" class="tabMenu" align="center">
   <tr>
      <td class="menu"><a href="index.php">Accueil</a></td>
      <td class="menu"><a href="listeEtablissements.php">
      Gestion établissements des ligues</a></td>
      <td class="menu"><a href="consultationAttributions.php">
      Attributions chambres</a></td>
   </tr>
</table>
-->
<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left">
            <li><a href="index.php">Accueil</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-center">
            <li><a href="listeEtablissements.php">Gestion établissements des ligues</a></li>
            <li><a href="consultationAttributions.php">Attributions chambres</a></li>
            <?php 
              
            
                echo"<li><a href='deconnexion.php'>déconnexion</a></li>";
        
            ?>
            
        </ul>
    </div>
</nav> 
<br>


