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

}
