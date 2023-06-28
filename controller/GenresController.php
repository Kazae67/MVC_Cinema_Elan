<?php

namespace Controller;

use Model\Connect;

class GenresController {
    
    /* Liste des GENRES */
    public function listGenres() {
        $pdo = Connect::Connexion();

        $query = "
            SELECT genre_name, id_genre, path_img_genre
            FROM genre 
        ";

        $request = $pdo->query($query);

        // Affiche la vue listGenres.php
        require "view/genre/listGenres.php"; 
    }

    /* Infos du GENRE */
    public function infosGenre($id_genre) {
        $pdo = Connect::Connexion();

        $query_genre_infos = "
            SELECT genre_name, id_genre, path_img_genre
            FROM genre
            WHERE id_genre = :id_genre
        ";
        // Récupère les informations du genre
        $request_genre_infos = $pdo->prepare($query_genre_infos);
        $request_genre_infos->execute(["id_genre" => $id_genre]);

        $genre_infos = $request_genre_infos->fetch();

        $query_genre_list_films = "
            SELECT f.titre_film, f.date_sortie, f.duree, g.genre_name, f.id_film, f.path_img_film
            FROM film_genre fg 
            INNER JOIN film f ON f.id_film = fg.id_film
            INNER JOIN genre g ON g.id_genre = fg.id_genre
            WHERE fg.id_genre = :id_genre
            ORDER BY f.date_sortie DESC
        ";
        // Récupère la liste des films appartenant au genre
        $request_genre_list_films = $pdo->prepare($query_genre_list_films);
        $request_genre_list_films->execute(["id_genre" => $id_genre]);

        
        // Affiche la vue infosGenre.php 
        require "view/genre/infosGenre.php"; 
    }

    /* Supprimer un GENRE */
    public function supprimerGenre($id_genre) {
        $pdo = Connect::Connexion();

        // Vérifier s'il y a des films associés à ce genre
        $query_check_films = "SELECT COUNT(*) FROM film_genre WHERE id_genre = :id_genre";
        $statement_check_films = $pdo->prepare($query_check_films);
        $statement_check_films->execute(["id_genre" => $id_genre]);

        // Supprimer les entrées dans la table film_genre associées au genre
        $query_delete_film_genre = "DELETE FROM film_genre WHERE id_genre = :id_genre";
        $statement_delete_film_genre = $pdo->prepare($query_delete_film_genre);
        $statement_delete_film_genre->execute(["id_genre" => $id_genre]);

        // Supprimer le genre de la base de données
        $query_delete_genre = "DELETE FROM genre WHERE id_genre = :id_genre";
        $statement_delete_genre = $pdo->prepare($query_delete_genre);
        $statement_delete_genre->execute(["id_genre" => $id_genre]);

        header("Location: index.php?action=listGenres");
        exit();
    }
}
