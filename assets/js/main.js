// assets/js/main.js

document.addEventListener('DOMContentLoaded', function () {
  console.log('Motaphoto theme JS is working!');
  toggleMenu();
  manageModale();
  lightbox();
});

// cette fonction permet d'afficher le menu en cliquant sur le bouton du menu burger affiché en responsive
function toggleMenu() {
  const navbar = document.querySelector('.navbar');
  const burger = document.querySelector('.burger');

  burger.addEventListener('click', (e) => {
    navbar.classList.toggle('show-nav');
  });

  const navbarLinks = document.querySelectorAll('.navbar a');
  navbarLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      navbar.classList.toggle('show-nav');
    });
  })

}

// cette fonction est utilisée pour afficher la modale du formulaire de contact via le click sur le btn contact du menu de nivagation
function manageModale() {
  const contactButtonOpen = document.getElementById('menu-item-16');
  const contactModale = document.getElementById('modale');
  const contactButtonClose = document.getElementById('close-modale');

  // Ajouter l'event de click sur le bouton contact du menu
  contactButtonOpen.addEventListener('click', (event) => {

    // vider le champs Ref. Photos avant d'afficher la modale du formulaire de contact 
    const refPhotoInput = document.querySelector('input[name="your-photo"]');
    refPhotoInput.value = "";
    // afficher la modale du fomrulaire de contact
    contactModale.showModal();
  });
  // Ajouter l'event pour fermer le modale
  contactButtonClose.addEventListener('click', (event) => {
    contactModale.close();
  });

  // Close the dialog if clicking outside of it
  contactModale.addEventListener('click', (event) => {
    const rect = contactModale.getBoundingClientRect();
    const isInDialog = (
      rect.top <= event.clientY && event.clientY <= rect.top + rect.height &&
      rect.left <= event.clientX && event.clientX <= rect.left + rect.width
    );

    if (!isInDialog) {
      contactModale.close();
    }
  });
}

// cette fonction est utilisée pour afficher la modale du formaulaire de contact avec la réf. photos pré-remplit
function openContactModalWithReference(reference) {
  // Sélection de l'élément input par son attribut name
  const refPhotoInput = document.querySelector('input[name="your-photo"]');
  // Vérification si l'élément input a été trouvé et la reference n'est pas vide
  if (refPhotoInput  && reference) {
    // Remplissage de la valeur du champ avec reference
    refPhotoInput.value = reference;
  } else {
    // Si l'élément input n'est pas trouvé
    console.log('Element input avec le nom "your-photo" non trouvé.');
  }
  const contactModale = document.getElementById('modale');
  contactModale.showModal();

}