<?php

namespace Controller;

use Model\Connect;

class FilmsController {

    /* Liste des FILMS */
    public function listFilms() {
        $pdo = Connect::Connexion();

        $query = '
            SELECT f.id_film, f.titre_film, f.date_sortie, f.duree, f.path_img_film, GROUP_CONCAT(g.genre_name SEPARATOR ", ") AS genres
            FROM film f
            LEFT JOIN film_genre fg ON fg.id_film = f.id_film
            LEFT JOIN genre g ON g.id_genre = fg.id_genre
            GROUP BY f.id_film
            ORDER BY f.date_sortie DESC
        ';

        $request = $pdo->query($query);

        // Affiche la vue listFilms.php
        require "view/film/listFilms.php";
    }

    /* Infos du FILM */
    public function infosFilm($id_film) {
        $pdo = Connect::Connexion();

        $query_film = "
            SELECT realisateur.id_realisateur, film.id_film, film.titre_film, film.date_sortie, film.duree, film.synopsis, film.note, personne.prenom AS rea_prenom, personne.nom AS rea_nom, film.path_img_film, GROUP_CONCAT(genre.id_genre) AS genre_ids, GROUP_CONCAT(genre.genre_name SEPARATOR ', ') AS genres
            FROM film
            INNER JOIN realisateur ON film.realisateur_id = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            INNER JOIN film_genre ON film.id_film = film_genre.id_film
            INNER JOIN genre ON film_genre.id_genre = genre.id_genre
            WHERE film.id_film = :id_film
            GROUP BY film.id_film
        ";

        // Récupère les informations du film
        $request_film = $pdo->prepare($query_film);
        $request_film->execute(["id_film" => $id_film]);

        $query_casting = "
            SELECT p.prenom, p.nom, r.role_name, a.id_acteur, r.id_role
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

    /* Supprimer un FILM */
    public function supprimerFilm($id_film) {
        $pdo = Connect::Connexion();

    // Supprimer les entrées correspondantes dans la table casting
    $query_delete_casting = "DELETE FROM casting WHERE film_id = :id_film";
    $statement_delete_casting = $pdo->prepare($query_delete_casting);
    $statement_delete_casting->execute(["id_film" => $id_film]);

    // Supprimer les entrées correspondantes dans la table film_genre
    $query_delete_film_genre = "DELETE FROM film_genre WHERE id_film = :id_film";
    $statement_delete_film_genre = $pdo->prepare($query_delete_film_genre);
    $statement_delete_film_genre->execute(["id_film" => $id_film]);

    // Supprimer le film de la base de données
    $query_delete_film = "DELETE FROM film WHERE id_film = :id_film";
    $statement_delete_film = $pdo->prepare($query_delete_film);
    $statement_delete_film->execute(["id_film" => $id_film]);

    // Supprimer le réalisateur si aucun autre film ne lui est associé
    $query_delete_realisateur = "DELETE FROM realisateur WHERE id_realisateur = (SELECT realisateur_id FROM film WHERE id_film = :id_film) AND id_personne NOT IN (SELECT id_personne FROM film WHERE realisateur_id = (SELECT realisateur_id FROM film WHERE id_film = :id_film))";
    $statement_delete_realisateur = $pdo->prepare($query_delete_realisateur);
    $statement_delete_realisateur->execute(["id_film" => $id_film]);

    header("Location: index.php?action=listFilms");
    exit(); 
}
}
