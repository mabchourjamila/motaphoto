// assets/js/main.js

document.addEventListener('DOMContentLoaded', function () {
  console.log('Motaphoto theme JS is working!');
  toggleMenu();
  manageModale();
});

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

function manageModale() {
  const contactButtonOpen = document.getElementById('menu-item-16');
  const contactModale = document.getElementById('modale');
  const contactButtonClose = document.getElementById('close-modale');

  // Ajouter l'event de click sur le bouton contact du menu
  contactButtonOpen.addEventListener('click', (event) => {
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