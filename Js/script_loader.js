// Attendre que la page soit entièrement chargée
window.addEventListener('load', function() {
    // Obtenir une référence vers le conteneur du loader
    var loaderContainer = document.getElementById('loader-container');
  
    // Arrêter le loader et rediriger après 2 secondes (2000 millisecondes)
    setTimeout(function() {
      // Cacher le conteneur du loader
      loaderContainer.style.display = 'none';
  
      // Rediriger vers une autre page
      window.location.href = '../../Indexe.php';
    }, 2000);
  });