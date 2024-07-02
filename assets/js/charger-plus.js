document.addEventListener('DOMContentLoaded', function() {
    
    // Initialisation de la page
    let page = 1;
    let ordreTriage = 'ASC';

    const chargerPlusBouton = document.getElementById('charger-plus');
    const zoneLesPhotos = document.querySelector('.zone-les-photos');
    const blocLesPhotos = document.querySelector('.bloc-les-photos');
    const selectionTriDESC = document.getElementById('DESC');


    chargerPlusBouton.addEventListener('click', async function() {
        ordreTriage = selectionTriDESC.classList.contains('selectionne') ? 'DESC' : 'ASC';

        // Incrémentation du numéro de page
        page++;
        
        // Création d'un objet pour envoyer la requête
        const data = new URLSearchParams();
        data.append('action', 'charger_plus');
        data.append('page', page);
        // Ajout du nonce de sécurité
        data.append('nonce', myAjax.nonce);
        // Ajout des filtres dans la pagination
        data.append('order', ordreTriage);
        data.append('category', window.categorieChangee ?? 'all');
        data.append('format', window.formatChange ?? 'all');
        console.log(window.categorieChangee, window.formatChange, window.triChange)

        try {
            // Envoi de la requête
            const reponse = await fetch(myAjax.ajaxurl, {
                method: 'POST',
                body: data,
            });

            if (reponse.ok) {
                // Réception de la réponse de la requête
                const responseData = await reponse.text();
                zoneLesPhotos.insertAdjacentHTML('beforeend', responseData);

                // Ajout d'un compte pour masquer le bouton (si moins de 8 éléments chargés)
                const parser = new DOMParser();
                const doc = parser.parseFromString(responseData, 'text/html');
                const figureCompte = doc.querySelectorAll('figure').length;

                lightbox();

                // Si moins de 8 éléments, le bouton disparait
                if (figureCompte < 8) {
                    chargerPlusBouton.style.display = 'none';
                }

            } else {
                chargerPlusBouton.style.display = 'none';
                // Création d'un message d'erreur
                const erreurMessage = document.createElement('div');
                erreurMessage.textContent = 'Une erreur s\'est produite lors du chargement du contenu. Veuillez réessayer ultérieurement.';
                erreurMessage.classList.add('message-erreur');
                blocLesPhotos.appendChild(erreurMessage);
            }
        } catch (error) {
            // Capture des erreurs afin de les rendre visibles dans la console
            console.error('Une erreur s\'est produite :', error);
        }
    });
});