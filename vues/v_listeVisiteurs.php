
<div class="row">  

<div class="col-sm-2">

<label>Choisir le visiteur:</label>

<?php if($uc == 'validerFrais'){ ?>

<form method="post" action="index.php?uc=validerFrais&action=listeMois" role="form">

<?php }else{ ?>

<form method="post" action="index.php?uc=suivrePaiement&action=listeVisiteurs" role="form">

<?php } ?>

<select class="form-control" name="idVisiteur">

<?php


foreach ($lesVisiteurs as $visiteur) : ?>


    <option <?php if(isset($visiteurSelectionner) AND $visiteurSelectionner === $visiteur['id']){  ?> 
    
    selected <?php } ?> value="<?= $visiteur['id'];?>">

    <?php echo $visiteur['prenom'] . ' ' .$visiteur['nom'] ?>

    </option>


<?php endforeach; ?>

</select> <br>


<button type="submit" class="btn btn-success">Valider</button>

</form>

</div>

</div>

<br>
