<?php

namespace Controller;

use Model\Connect;

class FilmsController {

    /* Liste des FILMS */
    public function listFilms() {
        $pdo = Connect::Connexion();

        $query = "
            SELECT id_film, titre_film, date_sortie, genre_name, duree, path_img_film
            FROM film
            INNER JOIN genre ON genre.id_genre = film.genre_id
            ORDER BY date_sortie DESC
        ";

        $request = $pdo->query($query);
        // Affiche la vue listFilms.php
        require "view/film/listFilms.php"; 
    }

    /*Infos du FILM */
    public function infosFilm($id_film) {
        $pdo = Connect::Connexion();
    
        $query_film = "
        SELECT realisateur.id_realisateur, film.id_film, film.titre_film, film.date_sortie, TIME_FORMAT(SEC_TO_TIME(film.duree*60), '%k h %i') AS duree, film.synopsis, film.note, personne.prenom AS rea_prenom, personne.nom AS rea_nom, film.path_img_film, film.genre_id, genre.genre_name
        FROM film
        INNER JOIN realisateur ON film.realisateur_id = realisateur.id_realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        INNER JOIN genre ON film.genre_id = genre.id_genre
        WHERE film.id_film = :id_film
        ";

        // Récupère les informations du film
        $request_film = $pdo->prepare($query_film);
        $request_film->execute(["id_film" => $id_film]);

        $query_casting = "
            SELECT p.prenom, p.nom, role_name, a.id_acteur, r.id_role
            FROM acteur a
            INNER JOIN casting c ON c.acteur_id = a.id_acteur
            INNER JOIN role r ON r.id_role = c.role_id
            INNER JOIN film f ON f.id_film = c.film_id
            INNER JOIN personne p ON a.id_personne = p.id_personne
            WHERE c.film_id = :id_film
        ";
    
        // Récupère la liste des acteurs et leurs rôles dans le film 
        $request_casting = $pdo->prepare($query_casting);
        $request_casting->execute(["id_film" => $id_film]);

        // Affiche la vue infosFilm.php
        require "view/film/infosFilm.php"; 
    }
}
