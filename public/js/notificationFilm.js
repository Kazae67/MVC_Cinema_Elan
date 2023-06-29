/* NOTIFICATION FILM */
function notificationFilm() {
  // Vérification du champ du titre du film
  var titreFilm = document.getElementById('titre_film').value.trim();

  if (titreFilm === '') {
    alert('Veuillez saisir le titre du film.');
    return false;
  }

  // Vérification du champ du réalisateur
  var realisateur = document.getElementById('realisateur_id').value;

  if (realisateur === '') {
    alert('Veuillez sélectionner un réalisateur.');
    return false;
  }

  // Vérification du champ de la date de sortie
  var dateSortie = document.getElementById('date_sortie').value.trim();

  if (dateSortie.length < 4) {
    alert('Veuillez entrer au moins 4 chiffres pour la date de sortie.');
    return false;
  }

  // Vérification du champ de la durée
  var duree = document.getElementById('duree').value.trim();

  if (!/\d+/.test(duree)) {
    alert('Veuillez entrer au moins 1 chiffre pour la durée.');
    return false;
  }

  // Vérification de la sélection d'une note
  var notes = document.getElementsByName('note');
  var noteSelected = false;

  for (var i = 0; i < notes.length; i++) {
    if (notes[i].checked) {
      noteSelected = true;
      break;
    }
  }

  if (!noteSelected) {
    alert('Veuillez sélectionner une note.');
    return false;
  }

  // Vérification de la sélection d'au moins un genre
  var genres = document.getElementsByName('genre_id[]');
  var genreSelected = false;

  for (var i = 0; i < genres.length; i++) {
    if (genres[i].checked) {
      genreSelected = true;
      break;
    }
  }

  if (!genreSelected) {
    alert('Veuillez sélectionner au moins un genre.');
    return false;
  }

  // Vérification de l'ajout d'une image
  var image = document.getElementById('image').value;

  if (image === '') {
    alert('Veuillez sélectionner une image.');
    return false;
  }

  // Affichage du message de réussite d'ajout du film
  alert('Le film a été ajouté avec succès!');
  return true;
}