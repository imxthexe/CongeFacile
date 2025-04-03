<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';
include '../../includes/functions.php';

$id = $_GET['id'];


$query = $bdd->prepare("
    SELECT 
        p.last_name AS Nom,
        p.first_name AS Prénom,
        u.email AS Email,
        d.name AS Département,
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
$manager = $query->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['update'])) {
    $nom = $_POST['userLastName'];
    $prenom = $_POST['userFirstName'];
    $email = $_POST['userEmail'];
    $department_id = $_POST['userDepartment'];
    $position_id = $_POST['userPosition'];
    $manager_id = $_POST['userManager'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    try {
      $bdd->beginTransaction(); // fonction php qui permet de démarer une transaction et voir si tout va bien

      // update person
      $queryPerson = $bdd->prepare("UPDATE person 
                    SET last_name = :nom, 
                    first_name = :prenom, 
                    department_id = :department, 
                    position_id = :position, 
                    manager_id = :manager 
                    WHERE id = (SELECT person_id FROM user WHERE id = :id)
            ");
      $queryPerson->bindParam(':nom', $nom);
      $queryPerson->bindParam(':prenom', $prenom);
      $queryPerson->bindParam(':department', $department_id);
      $queryPerson->bindParam(':position', $position_id);
      $queryPerson->bindParam(':manager', $manager_id);
      $queryPerson->bindParam(':id', $id);
      $queryPerson->execute();

      // Update email
      $queryUser = $bdd->prepare("UPDATE user 
                                        SET email = :email 
                                        WHERE id = :id");
      $queryUser->bindParam(':email', $email);
      $queryUser->bindParam(':id', $id);
      $queryUser->execute();

      // mot de passe
      if (!empty($newPassword) && $newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $queryPassword = $bdd->prepare("UPDATE user 
                                                SET password = :password 
                                                WHERE id = :id");
        $queryPassword->bindParam(':password', $hashedPassword);
        $queryPassword->bindParam(':id', $id);
        $queryPassword->execute();
      }



      $bdd->commit();
      header("Location: monEquipe2.php");
      exit;
    } catch (Exception $e) {
      $bdd->rollBack();
      echo "Erreur lors de la mise à jour : " . $e->getMessage();
    }
  } elseif (isset($_POST['delete'])) {
    try {
      $bdd->beginTransaction();

      $queryDeleteUser = $bdd->prepare("DELETE FROM user WHERE id = :id");
      $queryDeleteUser->bindParam(':id', $id);
      $queryDeleteUser->execute();

      $bdd->commit();
      header("Location: monEquipe2.php");
      exit;
    } catch (Exception $e) {
      $bdd->rollBack();
      echo "Erreur lors de la suppression : " . $e->getMessage();
    }
  }
}

var_dump($manager);
?>

<link rel="stylesheet" href="../../style.css" />

<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerUserDetail page">
    <section class="userDetailSection">
      <h2><?php echo htmlspecialchars($manager["Prénom"]) . " " . htmlspecialchars($manager["Nom"]) ?></h2>
      <div class="profilRow">
        <label class="switchWrapper">
          <input type="checkbox" id="profilActif" />
          <span class="slider"></span>
        </label>
        <p>Profil actif depuis le 05/03/2024</p>
      </div>

      <form class="userEditForm" method="POST">
        <label for="userEmail">Adresse email - champ obligatoire</label>
        <input type="email" id="userEmail" name="userEmail" value="<?php echo afficheValeur('Email', $manager) ?>" required />

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="userLastName">Nom de famille - champ obligatoire</label>
            <input type="text" id="userLastName" name="userLastName" value="<?php echo afficheValeur('Nom', $manager) ?>" required />
          </div>
          <div class="fieldGroup">
            <label for="userFirstName">Prénom - champ obligatoire</label>
            <input type="text" id="userFirstName" name="userFirstName" value="<?php echo afficheValeur('Prénom', $manager) ?>" required />
          </div>
        </div>

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="userPosition">Poste - champ obligatoire</label>
            <select id="userPosition" name="userPosition" required>
              <option value="1" <?php echo ($manager["position_id"] == 1) ? 'selected' : ''; ?>>Marketing</option>
              <option value="2" <?php echo ($manager["position_id"] == 2) ? 'selected' : ''; ?>>Développement Web</option>
            </select>
          </div>
          <div class="fieldGroup">
            <label for="userDepartment">Département - champ obligatoire</label>
            <select id="userDepartment" name="userDepartment" required>
              <option value="1" <?php echo ($manager["department_id"] == 1) ? 'selected' : ''; ?>>BU Symfony</option>
              <option value="2" <?php echo ($manager["department_id"] == 2) ? 'selected' : ''; ?>>BU Wordpress</option>
            </select>
          </div>
        </div>

        <label for="userManager">Manager</label>
        <select id="userManager" name="userManager">
          <option value="1" <?php echo ($manager["manager_id"] == 1) ? 'selected' : ''; ?>>Frédéric Salesse</option>
          <option value="2" <?php echo ($manager["manager_id"] == 2) ? 'selected' : ''; ?>>Olivier Salesse</option>
        </select>

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="newPassword">Nouveau mot de passe</label>
            <input type="password" id="newPassword" name="newPassword" />
          </div>
          <div class="fieldGroup">
            <label for="confirmPassword">Confirmation de mot de passe</label>
            <input type="password" id="confirmPassword" name="confirmPassword" />
          </div>
        </div>

        <div class="btnContainer">
          <button type="submit" name="delete" class="deleteBtn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">Supprimer</button>
          <button type="submit" name="update" class="updateBtn">Mettre à jour</button>
        </div>
      </form>
    </section>
  </div>
</div>
</body>

</html>