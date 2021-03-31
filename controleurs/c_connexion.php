<?php
/**
 * Gestion de la connexion
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
 * Récupère 'action' dans l'URL
 * envoie nul si aucun élément trouver
*/

$action = filtreUrl('action');


if (!$action) {

    $action = 'demandeconnexion';

}


switch ($action) {

case 'demandeConnexion':

    include 'vues/v_connexion.php';
    break;

case 'valideConnexion':

    $login = filtrePost('login');
    $mdp = filtrePost('mdp');
    
    $utilisateur = $pdo->getInfosVisiteurs($login, $mdp);


    if (!is_array($utilisateur)) {

        // Si aucun utilisateur a été trouvé 

        ajouterErreur('Login ou mot de passe incorrect');
        include 'vues/v_erreurs.php';
        include 'vues/v_connexion.php';

    } else {

        
        $id = $utilisateur['id'];
        $nom = $utilisateur['nom'];
        $prenom = $utilisateur['prenom'];
        $role = $utilisateur['role']; 
        

        // Créer une variable de session avec les informations de l'utilisateur  
        connecter($id, $nom, $prenom, $role);

        // redirection vers index.php (routeur)
        header('Location: index.php');

        
    }
    break;
    default:
    include 'vues/v_connexion.php';
    break;
}
