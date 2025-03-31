let messageSucces = document.getElementById('messageSucces');


if (!localStorage.getItem('messageShown')) {
    function showMessage() {
        messageSucces.classList.add('show');


        setTimeout(() => {
            messageSucces.classList.remove('show');
            messageSucces.classList.add('hide');


            localStorage.setItem('messageShown', 'true');
        }, 2000);
    }


    showMessage();
} else {

    messageSucces.style.display = 'none';
}