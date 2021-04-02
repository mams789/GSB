<?php
/**
 * Gestion des frais
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



// Récupération de l'ID du visiteur 
$idVisiteur = $_SESSION['utilisateur']['id'];


// Permet d'avoir le mois et l'année en cours 
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);


/** 
 * Récupere (filtre) 'action' dans l'URL
 * envoie nul si aucun élément est trouver
*/
$action = filtreUrl('action');


switch ($action) {
    
case 'saisirFrais':

    
    if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {

        // On créer une fiche de frais si aucune à été trouver pour ce visiteur et ce mois
        $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
        
    }
   
    break;

case 'validerMajFraisForfait':
    
    $infoFiche = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
        
    if($infoFiche['idEtat'] !== 'CL'){


    $lesFrais = filtreInput('lesFrais');
    
    // Vérifie que lesFrais ne contiennent que des valeurs numérique
    if (lesQteFraisValides($lesFrais)) {

        $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
        echo messageSuccess('Les valeurs ont été ajouter avec succès', 'success');
    }
    else {
        ajouterErreur('Les valeurs des frais doivent être numériques');
        include 'vues/v_erreurs.php';
    }

    
    }else{

        ajouterErreur('Vous ne pouvez pas faire de modification car la fiche est cloturé');
        include 'vues/v_erreurs.php';

    }


    
    break;

case 'validerCreationFrais':


    $infoFiche = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
        
    if($infoFiche['idEtat'] !== 'CL'){

    $dateFrais = filtrePost('dateFrais');
    $libelle = filtrePost('libelle');
    $montant = filtrePost('montant');

    



    valideInfosFrais($dateFrais, $libelle, $montant);

    if (nbErreurs() != 0) {
        include 'vues/v_erreurs.php';
    } else {
        $pdo->creeNouveauFraisHorsForfait(
            $idVisiteur,
            $mois,
            $libelle,
            $dateFrais,
            $montant
        );

        echo messageSuccess('Les valeurs ont été ajouter avec succès', 'success');
    }

    }else{

        ajouterErreur('Vous ne pouvez pas faire de modification car la fiche est cloturé');
        include 'vues/v_erreurs.php';

    }   
    break;

case 'supprimerFrais':

    $idFrais = filtreUrl('idFrais');
    $pdo->supprimerFraisHorsForfait($idFrais);

    break;
}

$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);


require 'vues/v_listeFraisForfait.php';
require 'vues/v_listeFraisHorsForfait.php';

    
