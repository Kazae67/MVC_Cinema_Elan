<?php
ob_start();
?>

<!-- Ajouter REALISATEUR -->
<div class="container">
    <div class="content">
        <form action="index.php?action=ajouterRealisateur" method="post" enctype="multipart/form-data">

            <!-- NOM -->
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            
            <!-- PRENOM -->
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
            
            <!-- SEXE -->
            <label for="sexe">Sexe :</label>
            <select name="sexe" id="sexe" required>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>

            <!-- DATE DE NAISSANCE -->
            <label for="birthdate">Date de naissance :</label>
            <input type="text" name="birthdate" id="birthdate" pattern="\d{2}/\d{2}/\d{4}" maxlength="10" placeholder="JJ/MM/AAAA" required>

            <!-- BIOGRAPHIE -->
            <label for="biographie">Biographie :</label>
            <textarea name="biographie" id="biographie" rows="5"></textarea>

            <!-- IMAGE -->
            <input type="file" name="image" id="image" accept="image/*">

            <!-- BOUTON -->
            <input type="submit" name="submit" value="Ajouter le realisateur" onclick="return notificationRealisateur()" class="submit-btn">
        </form>
    </div>
</div>

<script src="public/js/notificationRealisateur.js"></script>
<?php
$cssLink = '<link rel="stylesheet" href="public/css/formulaires/formulaires.css">';
$content = ob_get_clean();
require "view/template.php";
?>
