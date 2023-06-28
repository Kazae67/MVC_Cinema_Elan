<?php

namespace Controller;

use Model\Connect;

class CastingsController {

    /* Liste des CASTINGS */
    public function listCastings() {
        $pdo = Connect::Connexion();
        $request = $pdo->query("
        
            SELECT personne.prenom, personne.nom, role.role_name, film.titre_film, film.id_film, role.id_role, acteur.id_acteur, film.path_img_film, acteur.path_img_acteur, role.path_img_role
            FROM film
            INNER JOIN casting ON casting.film_id = film.id_film
            INNER JOIN role ON casting.role_id = role.id_role
            INNER JOIN acteur ON casting.acteur_id = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
        ");

        // Affiche la vue listCastings.php
        require "view/casting/listCastings.php";
    }
    
    public function supprimerCasting() {
        // Récupérer les paramètres d'URL
        $filmId = $_GET['film_id'];
        $acteurId = $_GET['acteur_id'];
        $roleId = $_GET['role_id'];
    
        // Construire la requête de suppression
        $pdo = Connect::Connexion();
        $query = "DELETE FROM casting WHERE film_id = :film_id AND acteur_id = :acteur_id AND role_id = :role_id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':film_id', $filmId);
        $statement->bindParam(':acteur_id', $acteurId);
        $statement->bindParam(':role_id', $roleId);
        $statement->execute();
    
        // Rediriger vers la liste des castings après la suppression
        header("Location: index.php?action=listCastings");
        exit();
    }

}
