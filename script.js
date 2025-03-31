let messageSucces = document.getElementById('messageSucces');
console.log(messageSucces);

messageSucces.classList.remove('hiddenMessageSucces');


setTimeout(() => {
    messageSucces.classList.add('hiddenMessageSucces');
}, 2000);