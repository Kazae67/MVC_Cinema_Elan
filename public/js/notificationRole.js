// notification d'ajout du rôle
function notificationRole() {
  var roleName = document.getElementById('role_name').value.trim();
  var image = document.getElementById('image').value;

    // Vérifier si le champ role est vide
    if (roleName === '') {
      alert('Veuillez entrer un rôle.');
      return false;
    }

    // Vérifier si le champ image est vide
    if (image === '') {
      alert('Veuillez sélectionner une image.');
      return false;
    }

    // Affichage du message de réussite d'ajout du rôle
    alert('Le rôle a été ajouté avec succès!');
    return true;
}