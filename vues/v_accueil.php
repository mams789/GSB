<?php
/**
 * Vue Accueil
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
?>

<div id="accueil">
    
    <h2>Gestion des frais<small> - <?= premiereLettreEnMajuscule($_SESSION['utilisateur']['role']) ?> : 
           
    <?php echo $_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom'] ?></small>

    </h2>

</div>


<div class="row">

<div class="col-md-12">

<div class="panel panel-primary">


<div class="panel-heading">

    <h3 class="panel-title"><span class="glyphicon glyphicon-bookmark"></span>Navigation</h3>

</div>

<div class="panel-body">
<div class="row">

<div class="col-xs-12 col-md-12">

<?php  
                           
if(estComptable()) { ?>

    <a href="index.php?uc=validerFrais&action=selectionnerVisiteur" class="btn btn-success btn-lg" role="button">
    <span class="glyphicon glyphicon-ok"></span>
    <br>
    Valider les fiches de frais
                            
<?php }  else { ?>

    <a href="index.php?uc=gererFrais&action=saisirFrais" class="btn btn-success btn-lg" role="button">
    <span class="glyphicon glyphicon-pencil"></span>
    <br>
    Renseigner la fiche de frais
                            
<?php  } ?>
                        
    </a>
                        
    <?php  
                           
    if(estComptable()) { ?>

    <a href="index.php?uc=suivrePaiement&action=listeVisiteurs" class="btn btn-primary btn-lg" role="button">
    <span class="glyphicon glyphicon-eur"></span>
    <br>
    Suivre le paiement des fiches de frais

    <?php  

    }else {

    ?>

    <a href="index.php?uc=etatFrais&action=selectionnerMois" class="btn btn-primary btn-lg" role="button">
    <span class="glyphicon glyphicon-list-alt"></span>
    <br>
    Afficher mes fiches de frais

    <?php  

    }
                           
    ?>
                        
    </a>

</div>
          
</div>

</div>

</div>

</div>

</div>