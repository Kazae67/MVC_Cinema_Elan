<!-- temporisation de sortie -->
<?php
ob_start();
/* L'image associée au réalisateur est affichée en utilisant les informations du chemin d'accès et du nom de fichier d'image stockées dans les variables. 
L'URL de l'image est générée en concaténant le chemin d'accès et le nom de fichier. */
$imagePathFilm = 'public/images/imgFilms/';
$imagePathActeur = 'public/images/imgActeurs/';
$imagePathRole = 'public/images/imgRoles/';
?>

<!-- La variable $liste est définie avec un message indiquant le nombre de castings disponibles. Si le nombre de castings est supérieur à 1, le texte est au pluriel. -->
<?php $liste = "<span class='casting-count'>Nombre de Casting".($request->rowCount() > 1 ? "s" : "")." disponible".($request->rowCount() > 1 ? "s" : ""); ?>

<!-- Afficher le nombre total de casting disponibles en utilisant la fonction rowCount() de l'objet $request. -->
<p class="row-count-list casting-count"> Un total de <?= $request->rowCount() ?> casting<?= ($request->rowCount() > 1) ? "s" : "" ?> disponible<?= ($request->rowCount() > 1) ? "s" : "" ?></p>

<!-- LISTE DES CARDS CASTING -->
<div class="casting-card-list">
    <?php
    /* Boucle foreach pour itérer sur chaque casting récupéré à partir de l'objet $request->fetchAll(). 
    Chaque réalisateur est affiché sous forme de card avec un lien vers les informations détaillées du casting. */
    foreach ($request->fetchAll() as $casting) { ?>
        <div class="casting-container">
            <div class="casting-images-container">
                <?php if (!empty($casting["prenom"])) { ?>
                    <div class="image-container">
                        <a href="index.php?action=infosActeur&id=<?= $casting['id_acteur'] ?>">
                            <img class="casting-image" src="<?= $imagePathActeur . $casting['path_img_acteur'] ?>" alt="affiche de l'acteur <?= $casting['prenom'] ?>">
                            <p class="casting-info"><?= $casting['nom'] . ' ' . $casting['prenom'] ?></p>
                        </a>
                    </div>
                <?php } ?>
                <?php if (!empty($casting["titre_film"])) { ?>
                    <div class="image-container">
                        <a href="index.php?action=infosFilm&id=<?= $casting['id_film'] ?>">
                            <img class="casting-image" src="<?= $imagePathFilm . $casting['path_img_film'] ?>" alt="affiche du film <?= $casting['titre_film'] ?>">
                            <p class="casting-info"><?= $casting['titre_film'] ?></p>
                        </a>
                    </div>
                <?php } ?>
                <?php if (!empty($casting["role_name"])) { ?>
                    <div class="image-container">
                        <a href="index.php?action=infosRole&id=<?= $casting['id_role'] ?>">
                            <img class="casting-image" src="<?= $imagePathRole . $casting['path_img_role'] ?>" alt="affiche du rôle <?= $casting['role_name'] ?>">
                            <p class="casting-info"><?= $casting['role_name'] ?></p>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- Ajouter le bouton de suppression avec un lien vers l'action de suppression -->
            <div class="delete-button-container">
                <a class="delete-button" href="index.php?action=supprimerCasting&film_id=<?= $casting['id_film'] ?>&acteur_id=<?= $casting['id_acteur'] ?>&role_id=<?= $casting['id_role'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce casting ?')">Supprimer</a>
            </div>
        </div>
    <?php } ?>
</div>

<?php
$content = ob_get_clean();
$cssLink = '<link rel="stylesheet" href="public/css/casting/listCastings.css">';
require "view/template.php";
?>