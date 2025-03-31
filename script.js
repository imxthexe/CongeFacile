let messageSucces = document.getElementById('messageSucces');

// Vérifie si le message a déjà été affiché dans cette session
if (!sessionStorage.getItem('messageShown')) {
    function showMessage() {
        messageSucces.classList.add('show');

        // Après 2 secondes, faire disparaître vers la droite
        setTimeout(() => {
            messageSucces.classList.remove('show');
            messageSucces.classList.add('hide');
        }, 2000);

        // Marquer le message comme affiché pour cette session
        sessionStorage.setItem('messageShown', 'true');
    }

    // Lancer l'animation
    showMessage();
} else {
    // Si déjà affiché dans cette session, cacher immédiatement l'élément
    messageSucces.style.display = 'none';
}