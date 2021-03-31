<?php
/**
 * Index du projet GSB
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

require_once 'includes/fct.inc.php';
require_once 'includes/class.pdogsb.inc.php';

// Démmare une session ou reprend une session déja existante
demarreUneSession();


$uc = filtrePost('uc');

// Objet qui représente la connexion à la BDD
$pdo = PdoGsb::getPdoGsb();


// Vérifie si un utilisateur est connectée
$estConnecte = estConnecte(); 

  
require 'vues/v_entete.php';




if ($uc && !$estConnecte) {

    $uc = 'connexion';

} elseif (empty($uc)) {

    $uc = 'accueil';
}


// Routeur

switch($uc) {
case 'connexion':
    include 'controleurs/c_connexion.php';
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'validerFrais':
    include 'controleurs/c_validerFrais.php';
    break;
case 'actualiserFrais':
    include 'controleurs/c_actualiserFrais.php';
    break;
case 'suivrePaiement':
    include 'controleurs/c_suivrePaiement.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
}

require 'vues/v_pied.php';
