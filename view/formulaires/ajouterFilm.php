<?php ob_start(); ?>

<!-- Ajouter FILM -->
<div class="container">
    <div class="content">
        <form action="index.php?action=ajouterFilm" method="post" enctype="multipart/form-data">

            <!-- TITRE -->
            <label for="titre_film">Titre :</label>
            <input type="text" name="titre_film" id="titre_film" placeholder="Nom du film" required>

            <!-- REALISATEUR -->
            <label for="realisateur_id">Réalisateur :</label>
            <select name="realisateur_id" id="realisateur_id">
                <?php foreach ($realisateurs as $realisateur) : ?>
                    <option value="<?php echo $realisateur['id_realisateur']; ?>"><?php echo $realisateur['nom'] . ' ' . $realisateur['prenom']; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- DATE DE SORTIE -->
            <label for="date_sortie">Date :</label>
            <input type="text" name="date_sortie" id="date_sortie" pattern="\year{4}" placeholder="Année de sortie" required>

            <!-- GENRES -->
            <label for="genre_id">Genres :</label>
            <?php foreach ($genres as $genre) : ?>
                <div>
                    <input type="checkbox" id="genre_<?php echo $genre['id_genre']; ?>" name="genre_id[]" value="<?php echo $genre['id_genre']; ?>">
                    <label for="genre_<?php echo $genre['id_genre']; ?>"><?php echo $genre['genre_name']; ?></label>
                </div>
            <?php endforeach; ?>

            <!-- NOTE -->
            <label for="note">Note :</label>
            <div class="note-input">
                <input type="radio" name="note" id="note-1" value="1" required>
                <label for="note-1">1</label>
                <input type="radio" name="note" id="note-2" value="2">
                <label for="note-2">2</label>
                <input type="radio" name="note" id="note-3" value="3">
                <label for="note-3">3</label>
                <input type="radio" name="note" id="note-4" value="4">
                <label for="note-4">4</label>
                <input type="radio" name="note" id="note-5" value="5">
                <label for="note-5">5</label>
            </div>

            <!-- DURÉE -->
            <div class="input-group">
                <label for="duree">Durée :</label>
                <input type="number" name="duree" id="duree" min="0" placeholder="En minute" required>
            </div>

            <!-- SYNOPSIS -->
            <label for="synopsis">Synopsis :</label>
            <textarea name="synopsis" id="synopsis" rows="5" required></textarea>

            <!-- IMAGE -->
            <label for="image">Image :</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <!-- BOUTON -->
            <input type="submit" value="Ajouter le film" onclick="notificationFilm()" class="submit-btn">

        </form>
    </div>
</div>

<script src="public/js/notificationAjouter.js"></script>
<?php
$cssLink = '<link rel="stylesheet" href="public/css/formulaires/ajouterFilm.css">';
$content = ob_get_clean();
require "view/template.php";
?>
