<?php

namespace Controller;

use Model\Connect;

class ActeursController {

    /* Liste des ACTEURS */
    public function listActeurs() {
        $pdo = Connect::Connexion();

        $query = "
            SELECT prenom, nom, sexe, DATE_FORMAT(birthdate, '%d-%m-%Y') AS birthdate, id_acteur, path_img_acteur
            FROM acteur a
            INNER JOIN personne on personne.id_personne = a.id_personne 
        ";

        $request = $pdo->query($query);
        // Affiche la vue listActeurs.php
        require "view/acteur/listActeurs.php"; 
    }

    /* Infos de l'ACTEUR */
    public function infosActeur($id_acteur) {
        $pdo = Connect::Connexion();
    
        $query_acteur_infos = "
            SELECT a.id_acteur, a.prenom, a.nom, a.sexe, DATE_FORMAT(a.birthdate, '%d/%m/%Y') AS birthdate, a.biographie
            FROM acteur a, personne p
            WHERE a.id_personne = p.id_personne
            AND a.id_acteur = :id
            
        ";
        $request_acteur_infos = $pdo->prepare($query_acteur_infos);
        $request_acteur_infos->execute(["id_acteur" => $id_acteur]);

        // Récupère les informations de l'acteur
        $query_acteur_list_films = "
            SELECT a.id_acteur, f.titre_film, f.date_sortie, r.id_role, r.role_name, f.id_film, f.path_img_film
            FROM acteur a
            INNER JOIN casting c ON c.acteur_id = a.id_acteur
            INNER JOIN film f ON f.id_film = c.film_id
            INNER JOIN role r ON r.id_role = c.role_id
            WHERE a.id_acteur = :id_acteur
        ";
        // Récupère la liste des films dans lesquels l'acteur a joué 
        $request_acteur_list_films = $pdo->prepare($query_acteur_list_films);
        $request_acteur_list_films->execute(["id_acteur" => $id_acteur]);

        // Affiche la vue infosActeur.php
        require "view/acteur/infosActeur.php"; 
    }
}
