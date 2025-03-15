<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Détails du compte - Lucas Dupas</title>
  <link rel="stylesheet" href="../../style.css" />
  <style>
    .containerUserDetail {
      flex: 1;
      padding: 80px 0 0 50px;
    }
    .containerUserDetail .userDetailSection {
      padding: 20px;
      width: 75%;
    }
    .containerUserDetail .userDetailSection h2 {
      font-size: 1.6rem;
      color: var(--color_title);
      margin-bottom: 10px;
    }
    .containerUserDetail .userDetailSection .profilRow {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }
    .containerUserDetail .userDetailSection .profilRow p {
      color: #555;
      margin: 0;
    }
    /* Formulaire */
    .containerUserDetail .userEditForm {
      max-width: 600px;
    }
    .containerUserDetail .userEditForm label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
    }
    .containerUserDetail .userEditForm input[type="text"],
    .containerUserDetail .userEditForm input[type="email"],
    .containerUserDetail .userEditForm input[type="password"],
    .containerUserDetail .userEditForm select {
      width: 350px;
      height: 40px;
      padding: 8px 12px;
      border: 1px solid var(--border);
      border-radius: 4px;
      font-size: 1rem;
      margin-bottom: 20px;
    }
    .containerUserDetail .userEditForm input[type="email"],
    .containerUserDetail .userEditForm input[type="password"] {
      padding-left: 40px ;
    }
    /* Groupes de champs côte à côte */
    .containerUserDetail .inlineFields {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }
    .containerUserDetail .inlineFields .fieldGroup {
      display: flex;
      flex-direction: column;
    }
    /* Boutons */
    .btnContainer {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }
    .deleteBtn {
      background-color: #e74c3c;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 16px;
      cursor: pointer;
      width: 200px;
    }
    .deleteBtn:hover {
      background-color: #c0392b;
    }
    .updateBtn {
      background-color: var(--color_btn);
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 16px;
      cursor: pointer;
      width: 150px;
    }
    .updateBtn:hover {
      background-color: #1565C0;
    }
    /* Style du toggle switch */
    .switchWrapper {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
    }
    .switchWrapper input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0; 
      left: 0; 
      right: 0; 
      bottom: 0;
      background-color: #ccc;
      transition: 0.4s;
      border-radius: 24px;
    }
    .slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: #fff;
      transition: 0.4s;
      border-radius: 50%;
    }
    .switchWrapper input:checked + .slider {
      background-color: var(--color_btn);
    }
    .switchWrapper input:checked + .slider:before {
      transform: translateX(26px);
    }
    @media screen and (max-width: 1080px) {
      .containerUserDetail {
        padding: 100px 20px 0 20px;
      }
      .containerUserDetail .inlineFields {
        display: block;
      }
      .containerUserDetail .inlineFields .fieldGroup {
        margin-bottom: 20px;
      }
      .btnContainer {
        display: block;
      }
      .deleteBtn,
      .updateBtn {
        width: 100%;
        margin-bottom: 10px;
      }
    }
  </style>
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
</head>
<body>
  <?php include "../../includes/header2.php"; ?>
  <div class="flex">
    <?php include "../../includes/navBar/navBar1.php"; ?>
    <div class="containerUserDetail">
      <section class="userDetailSection">
        <h2>Lucas Dupas</h2>
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
            value="j.martins@mentalworks.fr" 
            required
          />

          <div class="inlineFields">
            <div class="fieldGroup">
              <label for="userLastName">Nom de famille - champ obligatoire</label>
              <input 
                type="text" 
                id="userLastName" 
                name="userLastName" 
                value="Martins" 
                required
              />
            </div>
            <div class="fieldGroup">
              <label for="userFirstName">Prénom - champ obligatoire</label>
              <input 
                type="text" 
                id="userFirstName" 
                name="userFirstName" 
                value="Jeff" 
                required
              />
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

          <!-- Champ Manager transformé en select avec options -->
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
                name="newPassword"
              />
            </div>
            <div class="fieldGroup">
              <label for="confirmPassword">Confirmation de mot de passe</label>
              <input 
                type="password" 
                id="confirmPassword" 
                name="confirmPassword"
              />
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
</body>
</html>
