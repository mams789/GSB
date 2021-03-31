<?php 

/**
 * Vue Entête
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */


 /** 
 * Récupere (filtre) 'uc' dans l'URL
 * envoie nul si aucun élément est trouver
*/

$uc = filtreUrl('uc');


?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title> 
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="./styles/style.css" rel="stylesheet">
    </head>
<body>


<div class="container">


<?php if($estConnecte):?>

    <div class="header">
    <div class="row vertical-align">
    <div class="col-md-4">
    <h1><img src="./images/logo.jpg" class="img-responsive" 
    alt="Laboratoire Galaxy-Swiss Bourdin" 
    title="Laboratoire Galaxy-Swiss Bourdin">
    </h1>
    </div>


<div class="col-md-8">

    <ul class="nav nav-pills pull-right" role="tablist">
    <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
    <a href="index.php">
    <span class="glyphicon glyphicon-glyphicon-home"></span>
    Accueil</a>
    </li>

    <?php if(estComptable()) : ?>

            <li <?php if ($uc == 'validerFrais' || $uc == 'actualiserFrais') { ?>class="active"<?php } ?>>
            <a href="index.php?uc=validerFrais&action=selectionnerVisiteur">
            <span class="glyphicon glyphicon-ok"></span>
             Valider les fiches de frais

    <?php else : ?>

            <li <?php if ($uc == 'gererFrais') { ?>class="active"<?php } ?>>
            <a href="index.php?uc=gererFrais&action=saisirFrais">
            <span class="glyphicon glyphicon-pencil"></span>
            Renseigner la fiche de frais

    <?php endif; ?>
            </a>
            </li>


    <?php  if(estComptable()) : ?>

            <li <?php if ($uc == 'suivrePaiement') { ?>class="active"<?php } ?>>
            <a href="index.php?uc=suivrePaiement&action=listeVisiteurs">
            <span class="glyphicon glyphicon-eur"></span>
            Suivre le paiement des fiches de frais


    <?php else : ?>

            <li <?php if ($uc == 'etatFrais') { ?>class="active"<?php } ?>>
            <a href="index.php?uc=etatFrais&action=selectionnerMois">
            <span class="glyphicon glyphicon-list-alt"></span>
            Afficher mes fiches de frais

    <?php endif; ?>

            </a>
            </li>

            <li 

            <?php if ($uc == 'deconnexion') { ?>class="active"<?php } ?>>

            <a href="index.php?uc=deconnexion&action=demandeDeconnexion">

            <span class="glyphicon glyphicon-log-out"></span>

             Déconnexion
        
            </a>
            </li>

            </ul>

            </div>


</div> <!-- Fin div header -->

</div>  <!-- Fin div container -->


    <?php else :  ?>   

            <h1>
            <img src="./images/logo.jpg"
            class="img-responsive center-block"
            alt="Laboratoire Galaxy-Swiss Bourdin"
            title="Laboratoire Galaxy-Swiss Bourdin">
            </h1>

    <?php endif; ?>  


