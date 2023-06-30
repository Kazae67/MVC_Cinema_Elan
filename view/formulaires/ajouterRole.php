<?php
ob_start();
?>

<!-- Ajouter RÔLE -->
<div class="container">
    <div class="content">
        <form action="index.php?action=ajouterRole" method="post" enctype="multipart/form-data">

            <!-- RÔLE -->
            <label>Rôle :</label>
            <input type="textarea" name="role_name" id="role_name" required>

            <!-- DESCRIPTION -->
            <label>Description :</label>
            <textarea name="description" rows="5"></textarea>

            <!-- IMAGE -->
            <input type="file" name="image" id="image" required>

            <!-- BOUTON -->
            <input type="submit" name="submit" value="Ajouter le rôle" onclick="return notificationRole()" class="submit-btn">
        </form>

<script src="public/js/notificationRole.js"></script>
<?php
$cssLink = '<link rel="stylesheet" href="public/css/formulaires/formulaires.css">';
$content = ob_get_clean();
require "view/template.php";
?>
