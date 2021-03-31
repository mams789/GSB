<?php
/**
 * Vue Liste des frais hors forfait
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


<?php if(estComptable()) { ?>
    
<div class="row">

<div class="col-md-12" >
<div class="panel panel-danger">
<div class="panel-heading">Descriptif des éléments hors forfait</div>
<table class="table table-bordered table-responsive">
    <thead>
        <tr>
        <th class="date">Date</th>
        <th class="libelle">Libellé</th>  
        <th class="montant">Montant</th>  
        <th class="action">&nbsp;</th> 
        </tr>
        </thead>  
        <tbody>
    
<?php
        $nbJustificatifs=0;
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
  
            $nbJustificatifs++;
                
            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
            $libelle=  substr($libelle,0,20);
            $date = $unFraisHorsForfait['date'];
            $montant = $unFraisHorsForfait['montant'];
            $id = $unFraisHorsForfait['id'];
            
?>     

        <form action="index.php?uc=validerFrais&action=horsforfait"  method="post" role="form"> 
                 
            <tr> 
            <td><input class="form-control"  type="text" id="iddate" size="10" name="lesFraisD[<?php echo $id ?>]" value="<?php echo $date ; ?>" ></td>
            <td><input class="form-control" type="text" id="idlib" size="10"  name="lesFraisL[<?php echo $id ?>]" value="<?php echo $libelle ; ?>" ></td>    
            <td><input class="form-control" type="text" id="idmontant" size="10" name="lesFraisM[<?php echo $id ?>]" value="<?php echo $montant ;?>" ></td>
            <input id="id"  name="FraisHorsForfait[<?php echo $id ?>]" value="<?php echo $id ?>" type="hidden">  
            <input type="hidden" name="idVisiteur" value="<?= $idVisiteur ?>"></input>
            <input type="hidden" name="mois" value="<?= $mois ?>"></input>
            <td><button class="btn btn-success" type="submit" class="btn btn-default" name="corriger" value="corriger">Corriger</button>
            <button class="btn btn-success" type="submit" class="btn btn-default" name="reporter" value="reporter">reporter</button>
            <button class="btn btn-danger" type="reset" class="btn btn-default" >Reinitialiser</button> </td>     
          
        </form> 


        </tr>
        </div>      

<?php } ?>


        </div>

        </tbody>   
        </table>
       
        </div>
       
        <div class="form-group ">
            <form action="index.php?uc=validerFrais&action=valider_frais"  method="post" role="form"> 
            <label  class="col-form-label">Nombre de justificatifs:</label>
            <input class="form-control" id="nbJustificatifs" name="nbJustificatifs" value="<?php echo $nbJustificatifs; ?>" name="nbJustificatifs" style="width:50px;"> <br>
            <input type="hidden" name="idVisiteur" value="<?= $idVisiteur ?>"></input>
            <input type="hidden" name="mois" value="<?= $mois ?>"></input>
            <button class="btn btn-success" type="submit">Valider</button> 
            <button class="btn btn-danger" type="reset">Reinitialiser</button>  
        </form>

        </div>

        </div>

<?php } else { ?>

<hr>

<div class="row">

     <div class="col-md-12" >
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td> <?php echo $date ?></td>
                    <td> <?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                   
                    <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                </tr>
                <?php
            
            }
  
       ?>
        </tbody>   
        </table>
       </div>
             </div>
          </div>


          <div class="row">
           <div class="col-md-12" >
                   <h3>Nouvel élément hors forfait</h3>
                    <div class="col-md-4">
                    <form action="index.php?uc=gererFrais&action=validerCreationFrais" method="post" role="form">
                    <div class="form-group">
                    <label for="txtDateHF">Date (jj/mm/aaaa): </label>
                    <input type="text" id="txtDateHF" name="dateFrais" 
                    class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="txtLibelleHF">Libellé</label>             
                <input type="text" id="txtLibelleHF" name="libelle" 
                       class="form-control" id="text">
            </div> 
            <div class="form-group">
                <label for="txtMontantHF">Montant : </label>
                <div class="input-group">
                    <span class="input-group-addon">€</span>
                    <input type="text" id="txtMontantHF" name="montant" 
                           class="form-control" value="">
                </div>
            </div>
            <button class="btn btn-success" type="submit">Ajouter</button>
            <button class="btn btn-danger" type="reset">Effacer</button> 
        </form>
                             
    </div>
</div>
</div><br>

<?php } ?>