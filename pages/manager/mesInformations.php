<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = $_POST;
  $password = password_hash($infos['password'], PASSWORD_DEFAULT);



  if ($data['currentPassword'] != $password) {
    $errors['currentPassword'] = "votree mot de passe actuel ne correspond pas";
  }

  if (empty($data['currentPassword'])) {
    $errors['currentPassword'] = "Vueillez entrez votre mot de passe actuel";
  }
}
?>
<link rel="stylesheet" href="../../style.css" />



<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerMesInfos page">
    <section class="mesInfosSection">
      <h2>Mes informations</h2>
      <form class="mesInfosForm">
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
              value="<?php echo $infos['Nom'] ?>"
              required readonly>
          </div>
          <div class="fieldGroup">
            <label for="firstName">Prénom - champ obligatoire</label>
            <input
              type="text"
              id="firstName"
              name="firstName"
              value="<?php echo $infos['Prenom'] ?>"
              required readonly />
          </div>
        </div>

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="directionService">Direction/Service - champ obligatoire</label>
            <input
              type="text"
              value="<?php echo $infos['Departement'] ?>"
              required readonly />
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

        <h2>Réinitialiser mon mot de passe</h2>

        <label for="currentPassword">Mot de passe actuel</label>
        <input
          type="password"
          name="currentPassword" />

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="newPassword">Nouveau mot de passe</label>
            <input
              type="password"
              name="newPassword" />
          </div>
          <div class="fieldGroup">
            <label for="confirmPassword">Confirmation de mot de passe</label>
            <input
              type="password"
              name="confirmPassword" />
          </div>
        </div>

        <input type="submit" class="resetBtn" value="Réinitialiser le mot de passe">
      </form>
    </section>
  </div>
</div>
</body>

</html>