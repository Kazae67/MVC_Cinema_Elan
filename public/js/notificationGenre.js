// notification d'ajout du genre
function notificationGenre() {
  var genreName = document.getElementById('genre_name').value.trim();
  var image = document.getElementById('image').value;

    // Vérifier si le champ genre est vide
    if (genreName === '') {
      alert('Veuillez entrer un genre.');
      return false;
    }

    // Vérifier si le champ image est vide
    if (image === '') {
      alert('Veuillez sélectionner une image.');
      return false;
    }

    // Affichage du message de réussite d'ajout du genre
    alert('Le genre a été ajouté avec succès!');
    return true;
}