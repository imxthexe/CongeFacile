<?php
session_start();
$titre = 'Détails du collaborateur';

include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';
include '../../includes/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: monEquipe1.php');
    exit;
}

$query = $bdd->prepare("
    SELECT 
      p.id             AS person_id,
      p.last_name      AS Nom,
      p.first_name     AS Prénom,
      u.email          AS Email,
      d.name           AS Département,
      d.id             AS department_id,
      pos.id           AS position_id,
      pos.name         AS Position,
      p.manager_id     AS manager_id
    FROM user u
    JOIN person p ON u.person_id = p.id
    JOIN department d ON p.department_id = d.id
    JOIN positions pos ON p.position_id = pos.id
    WHERE u.id = :id
");
$query->execute(['id' => $id]);
$collab = $query->fetch(PDO::FETCH_ASSOC);

if (!$collab) {
    echo '<p style="background:#fdd; padding:10px; border-left:4px solid #f00;">
            ⚠ Collaborateur introuvable !
          </p>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 4.1) Suppression du collaborateur
    if (isset($_POST['delete'])) {
        try {
            $bdd->beginTransaction();

            $delUser = $bdd->prepare("DELETE FROM user WHERE id = :uid");
            $delUser->execute(['uid' => $id]);

            $bdd->commit();
            header('Location: monEquipe1.php');
            exit;

        } catch (Exception $e) {
            $bdd->rollBack();
            echo '<p style="background:#fdd; padding:10px; border-left:4px solid #f00;">
                    Erreur lors de la suppression : ' . htmlspecialchars($e->getMessage()) . '
                  </p>';
        }
    }

    if (isset($_POST['update'])) {
        $nom         = trim($_POST['userLastName']);
        $prenom      = trim($_POST['userFirstName']);
        $email       = trim($_POST['userEmail']);
        $dept_id     = intval($_POST['userDepartment']);
        $pos_id      = intval($_POST['userPosition']);
        $mgr_id      = $collab['manager_id']
        $newPwd      = $_POST['newPassword']     ?? '';
        $confirmPwd  = $_POST['confirmPassword'] ?? '';

        try {
            $bdd->beginTransaction();

            $updP = $bdd->prepare("
                UPDATE person
                SET last_name     = :nom,
                    first_name    = :prenom,
                    department_id = :dept,
                    position_id   = :pos,
                    manager_id    = :mgr
                WHERE id = :pid
            ");
            $updP->execute([
                'nom'   => $nom,
                'prenom'=> $prenom,
                'dept'  => $dept_id,
                'pos'   => $pos_id,
                'mgr'   => $mgr_id,
                'pid'   => $collab['person_id']
            ]);

            $updU = $bdd->prepare("
                UPDATE user
                SET email = :email
                WHERE id = :uid
            ");
            $updU->execute([
                'email' => $email,
                'uid'   => $id
            ]);

            if ($newPwd !== '' && $newPwd === $confirmPwd) {
                $updPwd = $bdd->prepare("
                    UPDATE user
                    SET password = :pwd
                    WHERE id = :uid
                ");
                $updPwd->execute([
                    'pwd' => password_hash($newPwd, PASSWORD_BCRYPT),
                    'uid' => $id
                ]);
            }

            $bdd->commit();
            header('Location: monEquipe1.php');
            exit;

        } catch (Exception $e) {
            $bdd->rollBack();
            echo '<p style="background:#fdd; padding:10px; border-left:4px solid #f00;">
                    Erreur lors de la mise à jour : ' . htmlspecialchars($e->getMessage()) . '
                  </p>';
        }
    }
}
?>

<link rel="stylesheet" href="../../style.css" />

<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerUserDetail page">
    <section class="userDetailSection">
      <h2>
        <?= htmlspecialchars($collab['Prénom']) ?>
        <?= htmlspecialchars($collab['Nom']) ?>
      </h2>

      <form class="userEditForm" method="POST">

        <label for="userEmail">Adresse email <span style="color:red;">*</span></label>
        <input type="email" id="userEmail" name="userEmail"
               value="<?= afficheValeur('Email', $collab) ?>" required />

        <div class="inlineFields">

          <div class="fieldGroup">
            <label for="userLastName">Nom <span style="color:red;">*</span></label>
            <input type="text" id="userLastName" name="userLastName"
                   value="<?= afficheValeur('Nom', $collab) ?>" required />
          </div>

          <div class="fieldGroup">
            <label for="userFirstName">Prénom <span style="color:red;">*</span></label>
            <input type="text" id="userFirstName" name="userFirstName"
                   value="<?= afficheValeur('Prénom', $collab) ?>" required />
          </div>
        </div>

        <div class="inlineFields">

          <div class="fieldGroup">
            <label for="userPosition">Poste <span style="color:red;">*</span></label>
            <select id="userPosition" name="userPosition" required>
              <option value="1" <?= $collab['position_id']==1?'selected':'' ?>>Marketing</option>
              <option value="2" <?= $collab['position_id']==2?'selected':'' ?>>Dév. Web</option>
            </select>
          </div>

          <div class="fieldGroup">
            <label for="userDepartment">Département <span style="color:red;">*</span></label>
            <select id="userDepartment" name="userDepartment" required>
              <option value="1" <?= $collab['department_id']==1?'selected':'' ?>>BU Symfony</option>
              <option value="2" <?= $collab['department_id']==2?'selected':'' ?>>BU Wordpress</option>
            </select>
          </div>
        </div>


        <input type="hidden" name="userManager" value="<?= htmlspecialchars($collab['manager_id']) ?>" />

        <div class="inlineFields">

          <div class="fieldGroup">
            <label for="newPassword">Nouveau mot de passe</label>
            <input type="password" id="newPassword" name="newPassword" />
          </div>

          <div class="fieldGroup">
            <label for="confirmPassword">Confirmation</label>
            <input type="password" id="confirmPassword" name="confirmPassword" />
          </div>
        </div>

        <div class="btnContainer">
          <button type="submit" name="update" class="updateBtn">Mettre à jour</button>
          <button type="submit" name="delete" class="deleteBtn"
                  onclick="return confirm('Supprimer ce collaborateur ? Cette action est irréversible.')">
            Supprimer
          </button>
        </div>
      </form>
    </section>
  </div>
</div>
</body>
</html>
