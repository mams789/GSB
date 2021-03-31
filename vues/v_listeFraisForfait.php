<?php
/**
 * Vue Liste des frais au forfait
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

<?php if(estComptable()): ?>

<div class="row">    
    
    <h2 class="text-primary">Valider la fiche de frais <br>
    <small> Visiteur : <?= $pdo->getNomVisiteur($idVisiteur); ?> 
    - Mois : <?= formatageDate($mois); ?></small>
    </h2>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
    <form method="post" action="index.php?uc=validerFrais&action=validerMajFraisForfait" role="form">

<?php else : ?>

<div class="row">    

    <h2>Renseigner ma fiche de frais du mois <?php echo $numMois . '-' . $numAnnee ?> </h2>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
    <form method="post" action="index.php?uc=gererFrais&action=validerMajFraisForfait" role="form">

<?php endif ?>


<fieldset>       
<?php foreach ($lesFraisForfait as $unFrais) {
        
    $idFrais = $unFrais['idfrais'];
    $libelle = htmlspecialchars($unFrais['libelle']);
    $quantite = $unFrais['quantite']; ?>
    <div class="form-group">
    <label for="idFrais"><?php echo $libelle ?></label>
    <input type="text" id="idFrais" name="lesFrais[<?php echo $idFrais ?>]" size="10" maxlength="5" 
    value="<?php echo $quantite ?>" 
    class="form-control">
    </div>
    <?php

}
?>



<?php 

if(estComptable()){

?>

<input type="hidden" name="idVisiteur" value="<?= $idVisiteur ?>"></input>
<input type="hidden" name="mois" value="<?= $mois ?>"></input>
<button class="btn btn-success" type="submit">Corriger</button>
<button class="btn btn-danger" type="reset">Réinitialiser</button> 


<?php } else { ?>

<button class="btn btn-success" type="submit">Ajouter</button>
<button class="btn btn-danger" type="reset">Effacer</button> 

<?php } ?>



</fieldset>
</form>
</div>
</div>
<br>
