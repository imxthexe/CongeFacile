<?php
session_start();
$titre = 'Ajouter un collaborateur';

include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$data   = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    // 1. Validations
    if (empty($data['userLastName']))      $errors['userLastName']   = 'Nom requis';
    if (empty($data['userFirstName']))     $errors['userFirstName']  = 'Prénom requis';
    if (empty($data['userEmail']))         $errors['userEmail']      = 'Email requis';
    if (empty($data['password']))          $errors['password']       = 'Mot de passe requis';
    if ($data['password'] !== $data['confirmPassword']) {
        $errors['confirmPassword'] = 'Les mots de passe ne correspondent pas';
    }

    // 2. Vérif unicité email
    $checkEmail = $bdd->prepare("SELECT id FROM user WHERE email = :email");
    $checkEmail->execute(['email' => $data['userEmail']]);
    if ($checkEmail->fetch()) {
        $errors['userEmail'] = 'Email déjà utilisé';
    }

    // 3. Insertion si pas d’erreur
    if (empty($errors)) {
        try {
            $bdd->beginTransaction();

            // 3.1 Insert person
            $stmtPerson = $bdd->prepare("
                INSERT INTO person 
                  (last_name, first_name, department_id, position_id, manager_id)
                VALUES 
                  (:last_name, :first_name, :department_id, :position_id, :manager_id)
            ");
            $stmtPerson->execute([
                'last_name'     => $data['userLastName'],
                'first_name'    => $data['userFirstName'],
                'department_id' => $data['userDepartment'],
                'position_id'   => $data['userPosition'],
                'manager_id'    => $data['userManager']
            ]);
            $person_id = $bdd->lastInsertId();

            // 3.2 Insert user
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmtUser = $bdd->prepare("
                INSERT INTO user 
                  (person_id, email, password)
                VALUES 
                  (:person_id, :email, :password)
            ");
            $stmtUser->execute([
                'person_id' => $person_id,
                'email'     => $data['userEmail'],
                'password'  => $hashedPassword
            ]);

            $bdd->commit();

            // 4. Redirection vers monEquipe1.php (au lieu de monEquipe2.php)
            header('Location: monEquipe1.php');
            exit;

        } catch (Exception $e) {
            $bdd->rollBack();
            echo '<p style="color:red;">Erreur : ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    }
}
?>

<link rel="stylesheet" href="../../style.css" />

<div class="flex">
  <?php include "../../includes/navBar/navBar3.php"; ?>
  <div class="containerUserDetail page">
    <section class="userDetailSection">
      <h2>Ajouter un collaborateur</h2>

      <form class="userEditForm" method="POST">
        <!-- Email -->
        <label for="userEmail">Adresse email <span style="color:red;">*</span></label>
        <input type="email" id="userEmail" name="userEmail"
               value="<?= afficheValeur('userEmail', $data) ?>" required />
        <?= afficheErreur('userEmail', $errors) ?>

        <div class="inlineFields">
          <!-- Nom -->
          <div class="fieldGroup">
            <label for="userLastName">Nom <span style="color:red;">*</span></label>
            <input type="text" id="userLastName" name="userLastName"
                   value="<?= afficheValeur('userLastName', $data) ?>" required />
            <?= afficheErreur('userLastName', $errors) ?>
          </div>
          <!-- Prénom -->
          <div class="fieldGroup">
            <label for="userFirstName">Prénom <span style="color:red;">*</span></label>
            <input type="text" id="userFirstName" name="userFirstName"
                   value="<?= afficheValeur('userFirstName', $data) ?>" required />
            <?= afficheErreur('userFirstName', $errors) ?>
          </div>
        </div>

        <div class="inlineFields">
          <!-- Poste -->
          <div class="fieldGroup">
            <label for="userPosition">Poste</label>
            <select id="userPosition" name="userPosition">
              <option value="1" <?= (isset($data['userPosition'])&&$data['userPosition']==1)?'selected':'' ?>>Marketing</option>
              <option value="2" <?= (isset($data['userPosition'])&&$data['userPosition']==2)?'selected':'' ?>>Dév. Web</option>
            </select>
          </div>
          <!-- Département -->
          <div class="fieldGroup">
            <label for="userDepartment">Département</label>
            <select id="userDepartment" name="userDepartment">
              <option value="1" <?= (isset($data['userDepartment'])&&$data['userDepartment']==1)?'selected':'' ?>>BU Symfony</option>
              <option value="2" <?= (isset($data['userDepartment'])&&$data['userDepartment']==2)?'selected':'' ?>>BU Wordpress</option>
            </select>
          </div>
        </div>

        <!-- Manager -->
        <label for="userManager">Manager</label>
        <select id="userManager" name="userManager">
          <option value="1" <?= (isset($data['userManager'])&&$data['userManager']==1)?'selected':'' ?>>Frédéric Salesse</option>
          <option value="2" <?= (isset($data['userManager'])&&$data['userManager']==2)?'selected':'' ?>>Olivier Salesse</option>
        </select>

        <div class="inlineFields">
          <!-- Mot de passe -->
          <div class="fieldGroup">
            <label for="password">Mot de passe <span style="color:red;">*</span></label>
            <input type="password" id="password" name="password" required />
            <?= afficheErreur('password', $errors) ?>
          </div>
          <!-- Confirmation -->
          <div class="fieldGroup">
            <label for="confirmPassword">Confirmation <span style="color:red;">*</span></label>
            <input type="password" id="confirmPassword" name="confirmPassword" required />
            <?= afficheErreur('confirmPassword', $errors) ?>
          </div>
        </div>

        <div class="btnContainer">
          <button type="submit" class="updateBtn">Créer le collaborateur</button>
        </div>
      </form>
    </section>
  </div>
</div>
</body>
</html>
