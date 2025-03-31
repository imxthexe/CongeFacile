<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';


$id = $_GET['id'];

// $recupRequest_name = $bdd->prepare('SELECT name FROM department WHERE id = :id');
// $recupRequest_name->bindParam(':id', $id);
// $recupRequest_name->execute();
// $name = $recupRequest_name->fetch(pdo::FETCH_ASSOC);

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;


        $querry = $bdd->prepare("UPDATE department
                                SET name = :nom
                                WHERE id = :id");
                                
        $querry->bindValue(':nom', $data['poste']);
        $querry->bindValue(':id', $id);
        $querry->execute();
        header('Location: postes.php');
}


?>

<link rel="stylesheet" href="../../style.css" />


<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerUserDetail page">
    <section class="userDetailSection">
      <h2><?php echo $_SESSION['utilisateur']['nom'] . " " . $_SESSION['utilisateur']['prenom'] ?></h2>
      <div class="profilRow">
        <label class="switchWrapper">
          <input type="checkbox" id="profilActif" />
          <span class="slider"></span>
        </label>
        <p>Profil actif depuis le 05/03/2024</p>
      </div>

      <form class="userEditForm" onsubmit="saveProfilActif(); return false;">
        <label for="userEmail">Adresse email - champ obligatoire</label>
        <input
          type="email"
          id="userEmail"
          name="userEmail"
          value="<?php echo $_SESSION['utilisateur']['email'] ?>"
          required />

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="userLastName">Nom de famille - champ obligatoire</label>
            <input
              type="text"
              id="userLastName"
              name="userLastName"
              value="<?php echo $_SESSION['utilisateur']['nom'] ?>"
              required />
          </div>
          <div class="fieldGroup">
            <label for="userFirstName">Prénom - champ obligatoire</label>
            <input
              type="text"
              id="userFirstName"
              name="userFirstName"
              value="<?php echo $_SESSION['utilisateur']['role'] ?>"
              required />
          </div>
        </div>

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="userDirection">Direction/Service - champ obligatoire</label>
            <select id="userDirection" name="userDirection" required>
              <option value="BU Symfony" selected>BU Symfony</option>
              <option value="BU Wordpress">BU Wordpress</option>
              <option value="BU Applications mobiles">BU Applications mobiles</option>
              <option value="BU Marketing">BU Marketing</option>
            </select>
          </div>
          <div class="fieldGroup">
            <label for="userPoste">Poste - champ obligatoire</label>
            <select id="userPoste" name="userPoste" required>
              <option value="Directeur technique">Directeur technique</option>
              <option value="Alternant développeur" selected>Alternant développeur</option>
              <option value="Développeur Web">Développeur Web</option>
              <option value="Graphiste">Graphiste</option>
            </select>
          </div>
        </div>

        <!
          <label for="userManager">Manager</label>
          <select id="userManager" name="userManager">
            <option value="Frédéric Salesse" selected>Frédéric Salesse</option>
            <option value="Olivier Salesse">Olivier Salesse</option>
            <option value="Jean-Noël Martin">Jean-Noël Martin</option>
            <option value="Matthias Rivien">Matthias Rivien</option>
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
            <button type="button" class="deleteBtn">Supprimer le compte</button>
            <button type="submit" class="updateBtn">Mettre à jour</button>
          </div>
      </form>
    </section>
  </div>
</div>

<script>
  function loadProfilActif() {
    const profilActif = localStorage.getItem("profilActif") === "true";
    document.getElementById("profilActif").checked = profilActif;
  }

  function saveProfilActif() {
    const profilActif = document.getElementById("profilActif").checked;
    localStorage.setItem("profilActif", profilActif);
    alert("Mise à jour effectuée !");
  }
  window.onload = loadProfilActif;
</script>

</body>

</html>