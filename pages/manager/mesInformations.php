<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';
include '../../includes/verifSecuriteManager.php';

$id = $_SESSION['utilisateur']['id'];

$query = $bdd->prepare("
    SELECT 
        p.last_name AS Nom,
        p.first_name AS Prenom,
        u.email AS Email,
        u.password AS password,
        d.name AS Departement,
        d.id AS department_id,
        pos.id AS position_id,
        pos.name AS Position,
        p.manager_id AS manager_id
        FROM user u
        JOIN person p ON u.person_id = p.id
        JOIN department d ON p.department_id = d.id
        JOIN positions pos ON p.position_id = pos.id
        WHERE u.id = :id
");
$query->bindParam(':id', $id);
$query->execute();
$infos = $query->fetch(PDO::FETCH_ASSOC);
$errors = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = $_POST;
  $data['currentPassword'] = trim($data['currentPassword']);
  $data['newPassword'] = trim($data['newPassword']);
  $data['confirmPassword'] = trim($data['confirmPassword']);

  $data['currentPassword'] = htmlspecialchars($data['currentPassword']);
  $data['newPassword'] = htmlspecialchars($data['newPassword']);
  $data['confirmPassword'] = htmlspecialchars($data['confirmPassword']);

  if (!password_verify($data['currentPassword'], $infos['password'])) {
    $errors['currentPassword'] = "Votre mot de passe actuel ne correspond pas.";
  }

  if (empty($data['currentPassword'])) {
    $errors['currentPassword'] = "Veuillez entrez votre mot de passe actuel";
  }

  if (empty($data['newPassword'])) {
    $errors['newPassword'] = "Veuillez rentrer votre nouveau mot de passe";
  }

  if ($data['newPassword'] !== $data['confirmPassword']) {
    $errors['newPassword'] = "Les deux mots de passe ne correspondent pas.";
  }

  if (empty($data['confirmPassword'])) {
    $errors['confirmPassword'] = "Rentrez votre nouveau mot de passe";
  }

  if ($data['newPassword'] == $data['currentPassword']) {
    $errors['newPassword'] = "Vous devez changer votre mot de passe pour le réinitialiser";
  }

  if (empty($errors)) {
    $id = $_SESSION['utilisateur']['id'];
    $password = password_hash($data['newPassword'], PASSWORD_DEFAULT);
    $updateMdp = $bdd->prepare("UPDATE user SET password = :password WHERE id = :id");
    $updateMdp->bindParam(':password', $password);
    $updateMdp->bindParam(':id', $id);
    $updateMdp->execute();
  }
}
?>


<link rel="stylesheet" href="../../style.css" />


<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerMesInfos page">
    <section class="mesInfosSection">
      <h2>Mes informations</h2>
      <form class="mesInfosForm" method="POST">
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
    </section>
  </div>
</div>

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


</body>

</html>