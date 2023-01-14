document.getElementById('contact-form').addEventListener('submit', function(e) {
  e.preventDefault();

  // Récupération des données du formulaire
  var prenom = document.getElementById('prenom').value;
  var email = document.getElementById('email').value;
  var object = document.getElementById('object').value;
  var message = document.getElementById('message').value;

  // Création de l\'objet XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Configuration de la requête
  xhr.open('POST', 'send-email.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Envoi de la requête avec les données du formulaire
  xhr.send('prenom=' + prenom + '&email=' + email + +'&object'= + object + '&message=' + message);

  // Gestion de la réponse
  xhr.onload = function() {
    if (xhr.status === 200) {
      alert(xhr.responseText);
    } else {
      alert('Il y a une erreur')
    }
}
})
