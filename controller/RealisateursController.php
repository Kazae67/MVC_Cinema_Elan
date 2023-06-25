<?php

namespace Controller;

use Model\Connect;

class RealisateursController {
    
    /* Liste des REALISATEURS */
    public function listRealisateurs() {
        $pdo = Connect::Connexion();
        
        $query = "
            SELECT prenom, nom, sexe, DATE_FORMAT(birthdate, '%d-%m-%Y') AS birthdate, id_realisateur, path_img_realisateur
            FROM realisateur r
            INNER JOIN personne on personne.id_personne = r.id_personne 
        ";

        $request = $pdo->query($query);

        // Affiche la vue listRealisateurs.php
        require "view/realisateur/listRealisateurs.php"; 
    }

    /* Infos du REALISATEUR */
    public function infosRealisateur($id_realisateur) {
        $pdo = Connect::Connexion();

        $query_realisateur_infos = "
            SELECT r.id_realisateur, p.prenom, p.nom, p.sexe, DATE_FORMAT(p.birthdate, '%d/%m/%Y') AS birthdate, r.biographie
            FROM realisateur r
            INNER JOIN personne p ON p.id_personne = r.id_personne
            WHERE r.id_realisateur = :id_realisateur
        ";
        
        // Récupère les informations du réalisateur
        $request_realisateur_infos = $pdo->prepare($query_realisateur_infos);
        $request_realisateur_infos->execute(["id_realisateur" => $id_realisateur]);

    
        $query_realisateur_list_films = "
            SELECT f.titre_film, f.date_sortie, f.duree, f.path_img_film, id_film
            FROM realisateur rea
            INNER JOIN film f ON f.realisateur_id = rea.id_realisateur
            WHERE rea.id_realisateur = :id_realisateur
        ";
        // Récupère la liste des films réalisés
        $request_realisateur_list_films = $pdo->prepare($query_realisateur_list_films);
        $request_realisateur_list_films->execute(["id_realisateur" => $id_realisateur]);

        
        // Affiche la vue infosRealisateur.php
        require "view/realisateur/infosRealisateur.php"; 
    }
}
