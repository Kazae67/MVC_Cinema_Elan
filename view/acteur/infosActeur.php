<?php
ob_start();
$imagePath = 'public/images/imgFilms/';
?>

<div class="container">
    <div class="content">
        <div class="acteur-card-detail">
            <?php if (isset($request_acteur_infos)) {
                $acteur_infos = $request_acteur_infos->fetch(); ?>
                <h2><?= $acteur_infos["prenom"] . " " . $acteur_infos["nom"] ?></h2>

                <p class="acteur-info">Cet acteur a joué un total de : <?= $request_acteur_list_films->rowCount() ?> film<?= ($request_acteur_list_films->rowCount() > 1) ? "s" : "" ?></p>
                <p>Né le : <?= $acteur_infos["birthdate"] ?></p>

                <?php if (isset($acteur_infos["biographie"])): ?>
                    <span class="acteur-info"><b>Biographie :</b> <?= $acteur_infos["biographie"] ?></span>
                <?php endif; ?>

                <span>
                    <b>Film<?= ($request_acteur_list_films->rowCount() > 1) ? "s" : "" ?> joué<?= ($request_acteur_list_films->rowCount() > 1) ? "s" : "" ?> :</b>
                </span>
            <?php } ?>

            <?php if ($request_acteur_list_films->rowCount() > 0) { ?>
                <div class="acteur-card-horizontal">
                    <?php foreach ($request_acteur_list_films->fetchAll() as $acteur_film) { ?>
                        <div class="acteur-container">
                            <a href="index.php?action=infosFilm&id=<?= $acteur_film['id_film'] ?>">
                                <div class="acteur-card">
                                    <!-- IMAGE -->
                                    <img class="acteur-image" src="<?= $imagePath . $acteur_film['path_img_film'] ?>" alt="affiche du film <?= $acteur_film['titre_film'] ?>">
                                    <div class="acteur-info">
                                        <h3 class="acteur-title"><a class="acteur-link" href="index.php?action=infosFilm&id=<?= $acteur_film['id_film'] ?>"><?= $acteur_film['titre_film'] ?></a>
                                            <?php if(isset($acteur_film['role_name'])): ?>
                                                <span class="acteur-role"><a class="acteur-link" href="index.php?action=infosRole&id=<?= $acteur_film['id_role'] ?>"><?= $acteur_film['role_name'] ?></a></span>
                                            <?php endif; ?>
                                            <span class="acteur-date"><?= $acteur_film['date_sortie'] ?></span>
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <span class="error">Cet acteur n'a joué dans aucun film.</span>
            <?php } ?>
        </div>
        <!-- bouton de suppression -->
        <form class="delete-actor-form" method="post" action="index.php?action=supprimerActeur&id=<?= $acteur_infos['id_acteur'] ?>">
            <button type="submit" class="btn delete-actor-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet acteur ?')">Supprimer l'acteur</button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$cssLink = '<link rel="stylesheet" href="public/css/acteur/infosActeur.css">';
require "view/template.php";
?>
