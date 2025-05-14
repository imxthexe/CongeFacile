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
        p.last_name     AS Nom,
        p.first_name    AS Prenom,
        u.email         AS Email,
        u.password      AS password,
        d.name          AS Departement,
        d.id            AS department_id,
        pos.id          AS position_id,
        pos.name        AS Position,
        p.manager_id    AS manager_id
    FROM user u
    JOIN person p ON u.person_id = p.id
    JOIN department d ON p.department_id = d.id
    JOIN positions pos ON p.position_id = pos.id
    WHERE u.id = :id
");
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$infos   = $query->fetch(PDO::FETCH_ASSOC);
$errors  = [];
$data    = [];
$success = '';
$RegexMDP = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $data['currentPassword'] = htmlspecialchars(trim($_POST['currentPassword'] ?? ''));
  $data['newPassword']     = htmlspecialchars(trim($_POST['newPassword']     ?? ''));
  $data['confirmPassword'] = htmlspecialchars(trim($_POST['confirmPassword'] ?? ''));


  if (empty($data['currentPassword'])) {
    $errors['currentPassword'] = "Veuillez entrer votre mot de passe actuel.";
  } elseif (!password_verify($data['currentPassword'], $infos['password'])) {
    $errors['currentPassword'] = "Votre mot de passe actuel ne correspond pas.";
  }

  if (empty($data['newPassword'])) {
    $errors['newPassword'] = "Veuillez rentrer votre nouveau mot de passe.";
  } elseif ($data['newPassword'] === $data['currentPassword']) {
    $errors['newPassword'] = "Le nouveau mot de passe doit être différent de l'actuel.";
  } elseif (!preg_match($RegexMDP, $data['newPassword'])) {
    $errors['newPassword'] = "Votre mot de passe doit contenir au minimum 8 caractères, 1 lettre majuscule, 1 chiffre et 1 caractère spécial";
  }

  if (empty($data['confirmPassword'])) {
    $errors['confirmPassword'] = "Veuillez confirmer votre nouveau mot de passe.";
  } elseif ($data['newPassword'] !== $data['confirmPassword']) {
    $errors['confirmPassword'] = "Les deux mots de passe ne correspondent pas.";
  }

  if (empty($errors)) {
    $newHash = password_hash($data['newPassword'], PASSWORD_DEFAULT);
    $updateMdp = $bdd->prepare("
            UPDATE user 
            SET password = :password 
            WHERE id = :id
        ");
    $updateMdp->execute([
      ':password' => $newHash,
      ':id'       => $id
    ]);
    $success = '✅ Mot de passe réinitialisé avec succès.';
    $data = [];
  }
}
?>

<link rel="stylesheet" href="../../style.css" />

<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerMesInfos page">
    <section class="mesInfosSection">
      <h2>Mes informations</h2>

      <?php if ($success): ?>
        <div style="
          background: #e6ffed;
          border-left: 4px solid #28a745;
          padding: 10px;
          margin-bottom: 1em;
          color: #155724;
        ">
          <?= $success ?>
        </div>
      <?php endif; ?>

      <form class="mesInfosForm" method="POST">
        <label for="emailAddress">Adresse email</label>
        <input type="email"
          id="emailAddress"
          name="emailAddress"
          value="<?= htmlspecialchars($infos['Email']) ?>"
          required
          readonly />

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="lastName">Nom de famille</label>
            <input type="text"
              id="lastName"
              name="lastName"
              value="<?= htmlspecialchars($infos['Nom']) ?>"
              required
              readonly />
          </div>
          <div class="fieldGroup">
            <label for="firstName">Prénom</label>
            <input type="text"
              id="firstName"
              name="firstName"
              value="<?= htmlspecialchars($infos['Prenom']) ?>"
              required
              readonly />
          </div>
        </div>

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="department">Direction/Service</label>
            <select id="department" name="department" disabled>
              <option selected><?= htmlspecialchars($infos['Departement']) ?></option>
            </select>
          </div>
          <div class="fieldGroup">
            <label for="position">Poste</label>
            <select id="position" name="position" disabled>
              <option selected><?= htmlspecialchars($infos['Position']) ?></option>
            </select>
          </div>
        </div>

        <h2>Réinitialiser mon mot de passe</h2>

        <label for="currentPassword">Mot de passe actuel</label>
        <div class="password-wrapper">
          <input type="password"
            id="currentPassword"
            name="currentPassword"
            value="<?= $data['currentPassword'] ?? '' ?>" />
          <i class="fa-regular fa-eye toggle-password"
            data-target="currentPassword"></i>
        </div>
        <?php if (isset($errors['currentPassword'])): ?>
          <p style="color:red;"><?= $errors['currentPassword'] ?></p>
        <?php endif; ?>

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="newPassword">Nouveau mot de passe</label>
            <div class="password-wrapper">
              <input type="password"
                id="newPassword"
                name="newPassword"
                value="<?= $data['newPassword'] ?? '' ?>" />
              <i class="fa-regular fa-eye toggle-password"
                data-target="newPassword"></i>
            </div>
            <?php if (isset($errors['newPassword'])): ?>
              <p style="color:red;"><?= $errors['newPassword'] ?></p>
            <?php endif; ?>
          </div>
          <div class="fieldGroup">
            <label for="confirmPassword">Confirmation de mot de passe</label>
            <div class="password-wrapper">
              <input type="password"
                id="confirmPassword"
                name="confirmPassword"
                value="<?= $data['confirmPassword'] ?? '' ?>" />
              <i class="fa-regular fa-eye toggle-password"
                data-target="confirmPassword"></i>
            </div>
            <?php if (isset($errors['confirmPassword'])): ?>
              <p style="color:red;"><?= $errors['confirmPassword'] ?></p>
            <?php endif; ?>
          </div>
        </div>

        <button type="submit" class="resetBtn">Réinitialiser le mot de passe</button>
      </form>
    </section>
  </div>
</div>

<script>
  document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function() {
      const target = document.getElementById(this.dataset.target);
      const type = target.type === 'password' ? 'text' : 'password';
      target.type = type;
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  });
</script>
</body>

</html>