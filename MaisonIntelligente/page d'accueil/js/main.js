document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner les éléments nécessaires
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const carousel = document.querySelector('.carousel-items');
  
    // Fonction pour défiler vers la gauche
    prevButton.addEventListener('click', function() {
      carousel.scrollBy({
        left: -250, // Défiler de 250px vers la gauche
        behavior: 'smooth' // Effet de défilement fluide
      });
    });
  
    // Fonction pour défiler vers la droite
    nextButton.addEventListener('click', function() {
      carousel.scrollBy({
        left: 250, // Défiler de 250px vers la droite
        behavior: 'smooth' // Effet de défilement fluide
      });
    });
  
    // Définition des objets pour la recherche
    const objets = [
      { nom: 'Lumière Salon', type: 'lumière', localisation: 'salon', etat: 'actif' },
      { nom: 'Thermostat Cuisine', type: 'thermostat', localisation: 'cuisine', etat: 'inactif' },
      { nom: 'Caméra Sécurité', type: 'caméra', localisation: 'entrée', etat: 'actif' },
      { nom: 'Lumière Chambre', type: 'lumière', localisation: 'chambre', etat: 'actif' }
    ];
  
    // Fonction de recherche
    function rechercher() {
      const type = document.getElementById('type').value;
      const localisation = document.getElementById('localisation').value.toLowerCase();
      const etat = document.getElementById('etat').value;
      const resultatsDiv = document.getElementById('resultats');
  
      const resultats = objets.filter(objet => {
        return (objet.type === type || type === '') &&
               (objet.localisation.toLowerCase().includes(localisation) || localisation === '') &&
               (objet.etat === etat || etat === '');
      });
  
      if (resultats.length > 0) {
        resultatsDiv.innerHTML = '<h3 class="font-semibold mb-2">Résultats de la recherche :</h3>';
        resultats.forEach(objet => {
          const p = document.createElement('p');
          p.textContent = `${objet.nom} - Localisation: ${objet.localisation} - État: ${objet.etat}`;
          resultatsDiv.appendChild(p);
        });
      } else {
        resultatsDiv.innerHTML = '<p class="text-red-500">Aucun objet trouvé selon vos critères.</p>';
      }
    }
  
    // Ajouter l'événement de recherche lorsque l'utilisateur clique sur un bouton ou soumet un formulaire
    document.getElementById('rechercher-btn').addEventListener('click', rechercher);
  });
  