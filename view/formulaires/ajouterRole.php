<?php
ob_start();
?>

<!-- Ajouter RÔLE -->
<form action="index.php?action=ajouterRole" method="post" enctype="multipart/form-data">

    <!-- RÔLE -->
    <label>Rôle :</label>
    <input type="textarea" name="role_name" id="role_name" required>

    <!-- DESCRIPTION -->
    <label>Description :</label>
    <textarea name="description" rows="5"></textarea>

    <!-- IMAGE -->
    <label>Image :</label>
    <input type="file" name="image" id="image" required>

    <!-- BOUTON -->
    <button type="submit" name="submit" value="Ajouter le rôle" onclick="return notificationRole()">Ajouter le role</button>
</form>

<script src="public/js/notificationRole.js"></script>
<?php
$cssLink = '<link rel="stylesheet" href="public/css/formulaires/formulaires.css">';
$content = ob_get_clean();
require "view/template.php";
?>
