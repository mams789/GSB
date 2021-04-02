<?php       

// Récupération des informations de l'utilisateur connectée
$idUtilisateur= $_SESSION['utilisateur']['id'];

/** 
 * Récupere (filtre) 'action' dans l'URL
 * envoie nul si aucun élément est trouver
*/

$action = filtreUrl('action');


switch ($action) {

case 'selectionnerVisiteur':

    // Récupération de tous les visiteurs
    $lesVisiteurs = $pdo->getVisiteur();


    include 'vues/v_listeVisiteurs.php';

    break;

    case 'listeMois':

    $visiteurSelectionner  = filtrePost('idVisiteur');

    // Récupération de tous les visiteurs
    $lesVisiteurs = $pdo->getVisiteur();

    // On vérifie que le visiteur a des fiche de frais a valider
    $lesmois = $pdo->getLesMois($visiteurSelectionner , 'CL');

    include 'vues/v_listeVisiteurs.php';

    if(!empty($lesmois)){
     
    include 'vues/v_mois.php';


    }else{

        ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
        include 'vues/v_erreurs.php';

    }

    break;

case 'voirFrais':

    /* 

    // Permet de modifier une fiche de frais

    $visiteurSelectionner  = filtrePost('idVisiteur');

    // Récupération de tous les visiteurs
    $lesVisiteurs = $pdo->getVisiteur();

    // On vérifie que le visiteur a des fiche de frais a valider
    $lesmois = $pdo->getLesMois($visiteurSelectionner , 'CL');

    
    include 'vues/v_listeVisiteurs.php';

    $idVisiteur  = filtrePost('idVisiteur');

    if(!empty($lesmois)){
     
    include 'vues/v_mois.php';


    }else{

        ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
        include 'vues/v_erreurs.php';

    }

    */

    $idVisiteur  = filtrePost('idVisiteur');
            
    $mois  = filtrePost('mois');

    
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);

    require 'vues/v_listeFraisForfait.php';
    require 'vues/v_listeFraisHorsForfait.php';

    break;


 case 'validerMajFraisForfait':  


    $idVisiteur  = filtrePost('idVisiteur');
    $mois  = filtrePost('mois');

    // Récupération des diférents frais corrigé
    $lesFrais = filtreInput('lesFrais');
  
    // Permet de vérifier que lesFrais contienne des valeurs numériques
    if(lesQteFraisValides($lesFrais)) { 
      
    // Met à jour la table ligneFraisForfait, selon l'utilisateur et le mois concerné
    $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
  
    echo messageSuccess("La fiche de frais à bien été corriger", "success");

    /* 

    $visiteurSelectionner  = filtrePost('idVisiteur');

    // Récupération de tous les visiteurs
    $lesVisiteurs = $pdo->getVisiteur();

    // On vérifie que le visiteur a des fiche de frais a valider
    $lesmois = $pdo->getLesMois($visiteurSelectionner , 'CL');

    include 'vues/v_listeVisiteurs.php';

    if(!empty($lesmois)){
     
    include 'vues/v_mois.php';


    }else{

        ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
        include 'vues/v_erreurs.php';

    }

       
    $idVisiteur  = filtrePost('idVisiteur');
    $mois  = filtrePost('mois');

    */
         
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);

    require 'vues/v_listeFraisForfait.php';
    require 'vues/v_listeFraisHorsForfait.php';
  
    }else {
  
    ajouterErreur('Les valeurs des frais doivent être numériques');
  
    include 'vues/v_erreurs.php';
  
    }

  
    break;

case'horsforfait':
     
    try
    {

    // Récupération des frais hors forfait

    $date = filtreInput('lesFraisD');
      
    $libelle = filtreInput('lesFraisL');
      
    $montant = filtreInput('lesFraisM');
      
    $idFrais = filtreInput('FraisHorsForfait');

    $idVisiteur  = filtrePost('idVisiteur');

    $mois  = filtrePost('mois');

    
    // Pour corriger la fiche de frais  

    if(isset($_POST['corriger'])){
      
    $pdo->SupprimerFrais($idVisiteur, $mois, $libelle, $idFrais);
      

    // Reporter les frais hort forfait au mois suivant

    }elseif(isset($_POST['reporter'])) {
          
    $moisActuel = (int)$mois + '1';

    $nouveauMois = (string)$moisActuel ;
      
    if($pdo->estPremierFraisMois($idVisiteur, $nouveauMois)) { 
      
    // On créer une nouvelle fiche pour le mois prochain (mois + 1)
    $pdo->creeNouvellesLignesFrais($idVisiteur, $nouveauMois);
      
    } 
      
    $pdo->creeFraisHorsForfait($idVisiteur,$nouveauMois ,$libelle,$date,$montant,$idFrais); 
    $moisActuel  = $nouveauMois  - 1;
      
    // Supression de la fiche initiale
    $pdo->supprimerLeFraisHorsForfait($idFrais,$moisActuel ); 

    }    
    }
      
    catch(Exception $e)
      
    {
      
    exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());
            
    }

    /*

    $visiteurSelectionner  = filtrePost('idVisiteur');

    // Récupération de tous les visiteurs
    $lesVisiteurs = $pdo->getVisiteur();

    // On vérifie que le visiteur a des fiche de frais a valider
    $lesmois = $pdo->getLesMois($visiteurSelectionner , 'CL');

    include 'vues/v_listeVisiteurs.php';

    if(!empty($lesmois)){
     
    include 'vues/v_mois.php';


    }else{

        ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
        include 'vues/v_erreurs.php';

    }

    $idVisiteur  = filtrePost('idVisiteur');
    $mois  = filtrePost('mois');

    
    */
            


    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);

    require 'vues/v_listeFraisForfait.php';
    require 'vues/v_listeFraisHorsForfait.php';
      
    break;
    
    // Valider la fiche de frais d'un visiteur

case 'valider_frais': 

    $nbJustificatifs = filtrePost('nbJustificatifs');

    $idVisiteur  = filtrePost('idVisiteur');

    $mois  = filtrePost('mois');

    try{ 

    $pdo->majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs); 

    $etat = "VA";

    // Mise à jour de la fiche à l'état valider
    $pdo->majEtatFicheFrais($idVisiteur, $mois, $etat);   

    }
            
    catch(Exception $e)
    {
        
        exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());
    
    }
        
    // Pour avoir le montant total

    $tabMontant = [
        'montantFrais' => 0,
        'montantFraisHorsForfait' => 0
    ];

    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois); 
 
    foreach ($lesFraisForfait as $unFraisForfait) {
         $quantite = 0;
         $quantite = $quantite+$unFraisForfait['quantite'];
         $tabMontant['montantFrais'] +=  $quantite * $pdo->getMontantFraisForfait($unFraisForfait['libelle']);
         
    } 

    
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);

    $montantFraisHorsForfait = 0;
              
    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                   $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                   $ref = substr($libelle, 0, 7); 
                   if($ref!=="REFUSER"){
                    $tabMontant['montantFraisHorsForfait'] += $montantFraisHorsForfait+$unFraisHorsForfait['montant'];
                   }
    }


    $montantTotal = $tabMontant['montantFrais'] + $tabMontant['montantFraisHorsForfait'];

    

    $pdo->montantValider($idVisiteur,$mois,$montantTotal);


    echo messageSuccess("La fiche à bien été valider !", "success");

    /*

    $visiteurSelectionner  = filtrePost('idVisiteur');

    // Récupération de tous les visiteurs
    $lesVisiteurs = $pdo->getVisiteur();

    // On vérifie que le visiteur a des fiche de frais a valider
    $lesmois = $pdo->getLesMois($visiteurSelectionner , 'CL');

    include 'vues/v_listeVisiteurs.php';

    if(!empty($lesmois)){
     
    include 'vues/v_mois.php';


    }else{

        ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
        include 'vues/v_erreurs.php';

    }

    
    $idVisiteur  = filtrePost('idVisiteur');
    $mois  = filtrePost('mois');

     */
    


    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);

    require 'vues/v_listeFraisForfait.php';
    require 'vues/v_listeFraisHorsForfait.php';

    break;
            
}



