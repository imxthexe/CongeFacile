let messageSucces = document.getElementById('messageSucces');

// Fonction pour afficher le message
function showMessage() {
    messageSucces.classList.add('show');

    // Masquer après 2 secondes
    setTimeout(() => {
        messageSucces.classList.remove('show');
        messageSucces.classList.add('hide');
    }, 2000);
}

// Exécuter la fonction pour voir l'effet
showMessage();