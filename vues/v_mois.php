
<div class="row"> 

<div class="col-sm-2">

<?php if($uc == 'validerFrais'){ ?>

<form method="post" action="index.php?uc=validerFrais&action=voirFrais" role="form">

<?php }else{ ?>

<form method="post" action="index.php?uc=suivrePaiement&action=afficherFiche" role="form">

<?php } ?>


<label>Sélectionner le mois:</label>

<select class="form-control" name="mois">

<?php foreach($lesmois as $mois): ?>

<option value="<?= $mois['mois']  ?>"><?= $mois['numMois'] . '/' . $mois['numAnnee'] ?></option>

<?php endforeach;  ?>

</select><br>

<input type="hidden" name="idVisiteur" value="<?= $visiteurSelectionner ?>"></input>

<button type="submit" class="btn btn-success">Valider</button>

</form>

</div>

</div>
