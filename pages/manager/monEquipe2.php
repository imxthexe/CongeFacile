<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';

$id = $_SESSION['utilisateur']['id']; // ID de l'utilisateur connecté

// Récupération des informations de l'utilisateur connecté
$query = $bdd->prepare("SELECT 
        p.last_name AS Nom,
        p.first_name AS Prénom,
        u.email AS Email,
        d.name AS Département,
        d.id AS department_id
        FROM user u
        JOIN person p ON u.person_id = p.id
        JOIN department d ON p.department_id = d.id
        WHERE u.id = :id
");

$query->bindParam(':id', $id);
$query->execute();
$manager = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['update'])) { // Mise à jour des informations
    $nom = $_POST['userLastName'];
    $prenom = $_POST['userFirstName'];
    $email = $_POST['userEmail'];
    $department_id = $_POST['userDirection']; // ID du département

    try {
      $bdd->beginTransaction();

      // Mise à jour du nom et prénom dans la table person
      $queryPerson = $bdd->prepare("UPDATE person SET last_name = :nom, first_name = :prenom, department_id = :department WHERE id = (SELECT person_id FROM user WHERE id = :id)");
      $queryPerson->bindParam(':nom', $nom);
      $queryPerson->bindParam(':prenom', $prenom);
      $queryPerson->bindParam(':department', $department_id);
      $queryPerson->bindParam(':id', $id);
      $queryPerson->execute();

      // Mise à jour de l'email dans la table user
      $queryUser = $bdd->prepare("UPDATE user SET email = :email WHERE id = :id");
      $queryUser->bindParam(':email', $email);
      $queryUser->bindParam(':id', $id);
      $queryUser->execute();

      $bdd->commit();
      header("Location: monEquipe2.php");
      exit;
    } catch (Exception $e) {
      $bdd->rollBack();
      echo "Erreur lors de la mise à jour : " . $e->getMessage();
    }
  } elseif (isset($_POST['delete'])) { // Suppression du compte
    try {
      $bdd->beginTransaction();

      // Suppression de l'utilisateur et de la personne associée
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
?>

<link rel="stylesheet" href="../../style.css" />

<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerUserDetail page">
    <section class="userDetailSection">
      <h2><?php echo htmlspecialchars($manager["Nom"]) . " " . htmlspecialchars($manager["Prénom"]) ?></h2>
      <div class="profilRow">
        <label class="switchWrapper">
          <input type="checkbox" id="profilActif" />
          <span class="slider"></span>
        </label>
        <p>Profil actif depuis le 05/03/2024</p>
      </div>

      <form class="userEditForm" method="POST">
        <label for="userEmail">Adresse email - champ obligatoire</label>
        <input type="email" id="userEmail" name="userEmail" value="<?php echo htmlspecialchars($manager["Email"]) ?>" required />

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="userLastName">Nom de famille - champ obligatoire</label>
            <input type="text" id="userLastName" name="userLastName" value="<?php echo htmlspecialchars($manager["Nom"]) ?>" required />
          </div>
          <div class="fieldGroup">
            <label for="userFirstName">Prénom - champ obligatoire</label>
            <input type="text" id="userFirstName" name="userFirstName" value="<?php echo htmlspecialchars($manager["Prénom"]) ?>" required />
          </div>
        </div>


        <!-- Positoin -->
        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="userDirection">Direction/Service - champ obligatoire</label>
            <select id="userDirection" name="userDirection" required>
              <option value="1" <?php echo ($manager["position_id"] == 1) ? 'selected' : ''; ?>>Marketing</option>
              <option value="2" <?php echo ($manager["position_id"] == 2) ? 'selected' : ''; ?>>Developpement web</option>
            </select>
          </div>
          <!-- departement -->
          <div class="fieldGroup">
            <label for="userPoste">Poste - champ obligatoire</label>
            <select id="userPoste" name="userPoste" required>
              <option value="1" <?php echo ($manager["department_id"] == 1) ? 'selected' : ''; ?>>Collaborateur</option>
              <option value="2" <?php echo ($manager["department_id"] == 2) ? 'selected' : ''; ?>>Manager</option>

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
            <input
              type="password"
              id="newPassword"
              name="newPassword" />
          </div>
          <div class="fieldGroup">
            <label for="confirmPassword">Confirmation de mot de passe</label>
            <input
              type="password"
              id="confirmPassword"
              name="confirmPassword" />
          </div>
        </div>



        <div class="btnContainer">
          <button type="submit" name="delete" class="deleteBtn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">Supprimer le compte</button>
          <button type="submit" name="update" class="updateBtn">Mettre à jour</button>
        </div>
      </form>
    </section>
  </div>
</div>

</body>

</html>