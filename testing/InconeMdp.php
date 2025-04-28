<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe avec icône FontAwesome</title>
    <!-- Lien FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



    <style>
        .password-container {
            position: relative;
            width: 300px;
        }
        .password-container input {
            width: 100%;
            padding-right: 40px;
            padding: 10px;
            font-size: 16px;
        }
        .password-container .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            color: #888;
        }
    </style>

    
</head>
<body>



<form method="post" action="traitement.php">
    <div class="password-container">
        <input type="password" id="password" name="password" placeholder="Mot de passe">
        <i class="fa-regular fa-eye toggle-password" id="togglePassword"></i>
    </div>
    <br>
    <button type="submit">Envoyer</button>
</form>









<script>
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Change l'icône
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});
</script>

</body>
</html>




<!-- 

Accueil
Infocmation


-->




























































