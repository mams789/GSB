<?php

// Récupération de l'action
$action = filtreUrl('action');


switch ($action) {

case 'listeVisiteurs':

    // Récupération de tous les visiteurs
    $lesVisiteurs = $pdo->getVisiteur();


    $visiteurSelectionner = filtrePost('idVisiteur');   

    
    include 'vues/v_listeVisiteurs.php';
    

    if($visiteurSelectionner !== null){

    if($pdo->getLesMoisEtats($visiteurSelectionner, 'CR')){

        // On récuperère les fiches de frais valider et/ou mise en paiement

        $lesmois = $pdo->getLesMoisEtats($visiteurSelectionner, 'CR');

        include 'vues/v_mois.php';


    }else{

        ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
        include 'vues/v_erreurs.php';
        break;

    }
   
    }

    break;

case 'afficherFiche':

        $mois  = filtrePost('mois');   
        $idVisiteur  = filtrePost('idVisiteur');  

        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        require 'vues/v_etatFrais.php';


    break;

case"mettreEnPaiement":

        $mois  = filtrePost('mois');   
        $idVisiteur  = filtrePost('idVisiteur');  

        // Vérifie l'état de la fiche de frais 

        $infoFiche = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);

        //var_dump($infoFiche['idEtat']); die();


        if (isset($_POST['mettreEnPaiement']) && $infoFiche['idEtat'] !== 'MP') {

             $etat = "MP";

             // Modifier l'état de la fiche en MP (Mise en paiement)
             $pdo->majEtatFicheFrais($idVisiteur, $mois, $etat); 

             echo messageSuccess('La fiche de frais est désormais mise en paiement', 'success');

            }else{

                ajouterErreur('La fiche est déja mise en paiement !');
                include 'vues/v_erreurs.php';

            }
        

            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
            require 'vues/v_etatFrais.php';
        
       
       
      

        
        break;

case 'remboursement':

            $mois  = filtrePost('mois');   
            $idVisiteur  = filtrePost('idVisiteur');  
    

            if(isset($_POST['remboursement'])) {

            $etat = "RB";

            $pdo-> majEtatFicheFrais($idVisiteur, $mois, $etat);

            echo messageSuccess('Vous venez d\'indiquer que la fiche a été payé !', 'info');

            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
            require 'vues/v_etatFrais.php';

        }
            
        break;


}

