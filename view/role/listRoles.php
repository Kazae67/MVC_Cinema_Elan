<!-- temporisation de sortie -->
<?php 
ob_start(); 
?>

<!-- La variable $liste est définie avec un message indiquant le nombre de rôles disponibles. Si le nombre de rôles est supérieur à 1, le texte est au pluriel. -->
<?php $liste = "Nombre de Rôle".($request->rowCount() > 1 ? "s" : "")." disponible".($request->rowCount() > 1 ? "s" : ""); ?>

<!-- Afficher le nombre total de rôles disponibles en utilisant la fonction rowCount() de l'objet $request. -->
<p class="row-count-list"> Un total de <?= $request->rowCount() ?> rôle<?= ($request->rowCount() > 1) ? "s" : "" ?> disponible<?= ($request->rowCount() > 1) ? "s" : "" ?></p>

<!-- LISTE DES CARDS ROLE -->
<div class="role-card-list">

    <!-- Boucle foreach pour itérer sur chaque rôles récupéré à partir de l'objet $request->fetchAll(). 
    Chaque rôle est affiché sous forme de card avec un lien vers les informations détaillées du rôle. -->
    <?php foreach ($request->fetchAll() as $role): ?>
        <div class="role-card">
            <a href="index.php?action=infosRole&id=<?= $role["id_role"] ?>">
                <!-- À l'intérieur de chaque card de rôle, le nom du rôle est affiché -->
                <div class="role-card-infos">
                    <span><?= "Role : ".$role["role_name"] ?></span>
                    <!-- Bouton supprimer -->
                    <a class="delete-role" href="index.php?action=supprimerRole&id_role=<?= $role["id_role"] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">Supprimer</a>
                </div>
                <!-- IMAGE --> 
                <!-- L'image associée au rôle est affichée en utilisant les informations du chemin d'accès et du nom de fichier d'image stockées dans les variables. 
                L'URL de l'image est générée en concaténant le chemin d'accès et le nom de fichier. -->
                <?php
                $imagePath = "public/images/imgRoles/";
                $imageFileName = $role["path_img_role"];
                $imageUrl = $imagePath . $imageFileName;
                ?>
                <!-- L'image du role est affichée en utilisant le chemin d'accès et le nom de fichier d'image stockés dans les variables. -->
                <img class="image-role" src="<?= $imageUrl ?>" alt="photo du role <?= ucfirst($role["role_name"]) ?>">
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
$cssLink = '<link rel="stylesheet" href="public/css/role/listRoles.css">';
require "view/template.php";
?>
