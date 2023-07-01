<?php
ob_start();
$imagePath = 'public/images/imgFilms/';
$film = $request_film->fetch();
$imageSrc = $imagePath . $film["path_img_film"];
?>

<div class="container">
    <div class="content">
        <div class="film-card-list">
            <div class="film-card-detail">
                <div class="film-info-line">
                    <span class="film-info-left"><b>Titre :</b> <?= $film["titre_film"] ?></span>
                    <span class="film-info-right"><b>Note :</b>
                        <!-- CONDITION ÉTOILES -->
                        <?php
                        $note = $film["note"];
                        if ($note >= 0 && $note <= 2) {
                            echo str_repeat("<i class='fa-solid fa-star red-star'></i>", $note);
                            echo str_repeat("<i class='fa-regular fa-star'></i>", 5 - $note);
                        } elseif ($note >= 3 && $note <= 4) {
                            echo str_repeat("<i class='fa-solid fa-star blue-star'></i>", $note);
                            echo str_repeat("<i class='fa-regular fa-star'></i>", 5 - $note);
                        } elseif ($note == 5) {
                            echo str_repeat("<i class='fa-solid fa-star gold-star animated'></i>", $note);
                        }
                        ?>
                    </span>
                </div>
                <div class="film-info-line">
                    <span class="film-info-left"><b>Réalisateur :</b> <a href="index.php?action=infosRealisateur&id=<?= $film['id_realisateur'] ?>"><?= $film["rea_nom"] . " " . $film["rea_prenom"] ?></a></span>
                    <span class="film-info-right"><b>Genre :</b>
                        <?php
                        $genre_ids = explode(",", $film['genre_ids']);
                        $genres = explode(",", $film['genres']);
                        

                        echo "Genres: ";
                        for ($i = 0; $i<count($genres);$i++) {
                            echo "<a href='index.php?action=infosGenre&id=".$genre_ids[$i]."'>" . ucfirst($genres[$i]) . "</a> ";
                        }
                        
                        ?>
                    </span>
                </div>
                <div class="film-info-line">
                    <span class="film-info-left"><b>Date de sortie :</b> <?= $film["date_sortie"] ?></span>
                    <span class="film-info-right"><b>Durée du film :</b>
                        <?php
                        $minutes = $film["duree"];
                        $duree = date('H:i', mktime(0, $minutes));
                        echo $duree . " mins";
                        ?>
                    </span>
                </div>
            </div>
            <div class="film-info-bottom">
                <div class="film-info-line">
                    <span class="film-info-full"><b>Synopsis :</b> <?= $film["synopsis"] ?></span>
                </div>

                <?php

                // VÉRIFICATION
                // Vérifier s'il y a des acteurs dans le casting
                if ($request_casting->rowCount() > 0) {
                    ?>
                    <div class="casting-info">
                        <span>Il y a un total de <?= $request_casting->rowCount() ?> acteur<?= ($request_casting->rowCount() > 1) ? "s" : "" ?> dans ce film :</span>
                        <ul class="casting-list">
                            <?php
                            // Parcourir tous les acteurs du casting
                            foreach ($request_casting->fetchAll() as $casting) {
                                ?>
                                <li>
                                    <a href="index.php?action=infosActeur&id=<?= $casting['id_acteur'] ?>">
                                        <?= $casting["prenom"] . " " . $casting["nom"] ?>
                                    </a> dans le rôle de
                                    <a href="index.php?action=infosRole&id=<?= $casting['id_role'] ?>">
                                        <?= $casting["role_name"] ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                } else {
                    ?>
                    <span class="error">Aucun acteur ajouté à ce film.</span>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="film-info-image">
            <img class="image-film-xl" src="<?= $imageSrc ?>" alt="affiche du film <?= $film["titre_film"] ?>">
        </div>
        <!-- bouton de suppression -->
        <div class="button-container">
            <form method="post" action="index.php?action=supprimerFilm&id=<?= $film['id_film'] ?>">
                <button type="submit" class="btn delete-film-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?')">Supprimer le film</button>
            </form>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
$cssLink = '<link rel="stylesheet" href="public/css/film/infosFilm.css">';
require "view/template.php";
?>
