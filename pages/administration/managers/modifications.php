<?php
session_start();
$titre = 'Informations Manager';
include '../../../includes/database.php';
include '../../../includes/header2.php';
include '../../../includes/functions.php';
include '../../../includes/verifSecuriteManager.php';


$RecupInfosManagers = $bdd->prepare("SELECT 
    u.email,
    u.password,
    p.last_name,
    p.first_name,
    d.name AS department
FROM 
    user u
JOIN 
    person p ON u.person_id = p.id
JOIN 
    department d ON p.department_id = d.id
WHERE 
    u.role = 'manager';");

$RecupInfosManagers->execute();
$InfosManagers = $RecupInfosManagers->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../../../style.css">
<div class="flex">
    <?php include "../../../includes/header3.php"; ?>
    <?php include "../../../includes/navBar/navBar3.php"; ?>
    <div class="containerMesInfos page">
        <section class="mesInfosSection">
            <h2>Mes informations</h2>
            <form class="mesInfosForm" method="POST">
                <label for="emailAddress">Adresse email - champ obligatoire</label>
                <input
                    type="email"
                    id="emailAddress"
                    name="emailAddress"
                    value="<?php echo $infos['Email'] ?>"
                    required readonly />

                <div class="inlineFields">
                    <div class="fieldGroup">
                        <label for="lastName">Nom de famille - champ obligatoire</label>
                        <input
                            type="text"
                            id="lastName"
                            name="lastName"
                            value="<?= $infos['Nom'] ?>"
                            required readonly />
                    </div>
                    <div class="fieldGroup">
                        <label for="firstName">Prénom - champ obligatoire</label>
                        <input
                            type="text"
                            id="firstName"
                            name="firstName"
                            value="<?= $infos['Prenom'] ?>"
                            required readonly />
                    </div>
                </div>

                <div class="inlineFields">
                    <div class="fieldGroup">
                        <label for="directionService">Direction/Service - champ obligatoire</label>

                        <input
                            type="text"
                            id="firstName"
                            name="firstName"
                            value="<?= $infos['Departement'] ?>"
                            required readonly />
                    </div>

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
        </section>
    </div>
</div>

<script>
    const toggleIcons = document.querySelectorAll('.toggle-password');

    toggleIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);

            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>

</html>