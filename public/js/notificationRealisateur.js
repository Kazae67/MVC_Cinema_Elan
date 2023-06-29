function notificationRealisateur() {
    var nom = document.getElementById('nom').value.trim();
    var prenom = document.getElementById('prenom').value.trim();
    var birthdate = document.getElementById('birthdate').value.trim();
    var image = document.getElementById('image').value;
  
    // Vérifier si le champ nom est vide
    if (nom === '') {
      alert('Veuillez entrer un nom.');
      return false;
    }
  
    // Vérifier si le champ prénom est vide
    if (prenom === '') {
      alert('Veuillez entrer un prénom.');
      return false;
    }
  
    // Vérifier si le champ date de naissance est vide
    if (birthdate === '') {
      alert('Veuillez entrer une date de naissance.');
      return false;
    }
  
    // Vérifier si le champ image est vide
    if (image === '') {
      alert('Veuillez sélectionner une image.');
      return false;
    }
  
    // Vérifier et formater la date (JJ/MM/AAAA)
    var datePattern = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!datePattern.test(birthdate)) {
      alert('Veuillez entrer une date de naissance valide au format JJ/MM/AAAA.');
      return false;
    }
  
    // Afficher une alerte de succès
    var message = "L'acteur a été ajouté avec succès!";
    alert(message);
    return true;
  }
  
  // Formater la valeur de l'entrée au format 'JJ/MM/AAAA'
  var birthdateInput = document.getElementById('birthdate');
  birthdateInput.addEventListener('input', function (e) {
    var input = e.target;
    var value = input.value.replace(/\D/g, ''); // Supprime tous les caractères non numériques
    var formattedValue = '';
  
    if (value.length > 2) {
      formattedValue += value.substr(0, 2) + '/';
      if (value.length > 4) {
        formattedValue += value.substr(2, 2) + '/';
        formattedValue += value.substr(4, 4);
      } else {
        formattedValue += value.substr(2);
      }
    } else {
      formattedValue = value;
    }
  
    input.value = formattedValue;
  });
  