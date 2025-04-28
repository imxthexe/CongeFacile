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




































































<form class="mesInfosForm">
    <label for="emailAddress">Adresse email - champ obligatoire</label>
    <input
        type="email"
        id="emailAddress"
        name="emailAddress"
        value="salesse@mentalworks.fr"
        required />

    <div class="inlineFields">
        <div class="fieldGroup">
            <label for="lastName">Nom de famille - champ obligatoire</label>
            <input
                type="text"
                id="lastName"
                name="lastName"
                value="Salesse"
                required />
        </div>
        <div class="fieldGroup">
            <label for="firstName">Prénom - champ obligatoire</label>
            <input
                type="text"
                id="firstName"
                name="firstName"
                value="Frédéric"
                required />
        </div>
    </div>

    <div class="inlineFields">
        <div class="fieldGroup">
            <label for="directionService">Direction/Service - champ obligatoire</label>
            <select id="directionService" name="directionService" required>
                <option value="BU Symfony" selected>BU Symfony</option>
                <option value="BU Wordpress">BU Wordpress</option>
                <option value="BU Applications mobiles">BU Applications mobiles</option>
                <option value="BU Marketing">BU Marketing</option>
            </select>
        </div>
        <div class="fieldGroup">
            <label for="poste">Poste - champ obligatoire</label>
            <select id="poste" name="poste" required>
                <option value="Directeur technique">Directeur technique</option>
                <option value="Lead Développeur">Lead Développeur</option>
                <option value="Développeur Web">Développeur Web</option>
                <option value="Graphiste">Graphiste</option>
            </select>
        </div>
    </div>

    <label for="manager">Manager</label>
    <input
        type="text"
        id="manager"
        name="manager"
        value="Frédéric Salesse"
        readonly />

    <h2>Réinitialiser mon mot de passe</h2>

    <label for="currentPassword">Mot de passe actuel</label>
    <div class="password-wrapper">
        <input type="password" id="currentPassword" name="currentPassword" />
        <i class="fa-regular fa-eye toggle-password" data-target="currentPassword"></i>
    </div>

    <div class="inlineFields">
        <div class="fieldGroup">
            <label for="newPassword">Nouveau mot de passe</label>
            <div class="password-wrapper">
                <input type="password" id="newPassword" name="newPassword" />
                <i class="fa-regular fa-eye toggle-password" data-target="newPassword"></i>
            </div>
        </div>
        <div class="fieldGroup">
            <label for="confirmPassword">Confirmation de mot de passe</label>
            <div class="password-wrapper">
                <input type="password" id="confirmPassword" name="confirmPassword" />
                <i class="fa-regular fa-eye toggle-password" data-target="confirmPassword"></i>
            </div>
        </div>
    </div>

    <button type="button" class="resetBtn">Réinitialiser le mot de passe</button>
</form>

<!-- FontAwesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.password-wrapper {
    position: relative;
}

.password-wrapper input {
    width: 100%;
    padding-right: 40px; /* Espace pour l'icône à l'intérieur */
    box-sizing: border-box;
}

.password-wrapper .toggle-password {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #aaa;
    font-size: 18px;
}
</style>

<script>
const toggleIcons = document.querySelectorAll('.toggle-password');

toggleIcons.forEach(icon => {
    icon.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const passwordInput = document.getElementById(targetId);

        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});
</script>












<form class="mesInfosForm">
    <label for="emailAddress">Adresse email - champ obligatoire</label>
    <input
        type="email"
        id="emailAddress"
        name="emailAddress"
        value="salesse@mentalworks.fr"
        required />

    <div class="inlineFields">
        <div class="fieldGroup">
            <label for="lastName">Nom de famille - champ obligatoire</label>
            <input
                type="text"
                id="lastName"
                name="lastName"
                value="Salesse"
                required />
        </div>
        <div class="fieldGroup">
            <label for="firstName">Prénom - champ obligatoire</label>
            <input
                type="text"
                id="firstName"
                name="firstName"
                value="Frédéric"
                required />
        </div>
    </div>

    <div class="inlineFields">
        <div class="fieldGroup">
            <label for="directionService">Direction/Service - champ obligatoire</label>
            <select id="directionService" name="directionService" required>
                <option value="BU Symfony" selected>BU Symfony</option>
                <option value="BU Wordpress">BU Wordpress</option>
                <option value="BU Applications mobiles">BU Applications mobiles</option>
                <option value="BU Marketing">BU Marketing</option>
            </select>
        </div>
        <div class="fieldGroup">
            <label for="poste">Poste - champ obligatoire</label>
            <select id="poste" name="poste" required>
                <option value="Directeur technique">Directeur technique</option>
                <option value="Lead Développeur">Lead Développeur</option>
                <option value="Développeur Web">Développeur Web</option>
                <option value="Graphiste">Graphiste</option>
            </select>
        </div>
    </div>

    <label for="manager">Manager</label>
    <input
        type="text"
        id="manager"
        name="manager"
        value="Frédéric Salesse"
        readonly />

    <h2>Réinitialiser mon mot de passe</h2>

    <label for="currentPassword">Mot de passe actuel</label>
    <div class="password-wrapper">
        <input type="password" id="currentPassword" name="currentPassword" />
        <i class="fa-regular fa-eye toggle-password" data-target="currentPassword"></i>
    </div>

    <div class="inlineFields">
        <div class="fieldGroup">
            <label for="newPassword">Nouveau mot de passe</label>
            <div class="password-wrapper">
                <input type="password" id="newPassword" name="newPassword" />
                <i class="fa-regular fa-eye toggle-password" data-target="newPassword"></i>
            </div>
        </div>
        <div class="fieldGroup">
            <label for="confirmPassword">Confirmation de mot de passe</label>
            <div class="password-wrapper">
                <input type="password" id="confirmPassword" name="confirmPassword" />
                <i class="fa-regular fa-eye toggle-password" data-target="confirmPassword"></i>
            </div>
        </div>
    </div>

    <button type="button" class="resetBtn">Réinitialiser le mot de passe</button>
</form>

<!-- FontAwesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.password-wrapper {
    position: relative;
}

.password-wrapper input {
    width: 100%;
    padding-right: 40px; /* Espace pour l'icône à l'intérieur */
    box-sizing: border-box;
}

.password-wrapper .toggle-password {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #aaa;
    font-size: 18px;
}
</style>

<script>
const toggleIcons = document.querySelectorAll('.toggle-password');

toggleIcons.forEach(icon => {
    icon.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const passwordInput = document.getElementById(targetId);

        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});
</script>



