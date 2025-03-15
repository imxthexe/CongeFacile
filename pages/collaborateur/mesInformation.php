<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes informations</title>
  <link rel="stylesheet" href="../../style.css">
  <style>
    .containerMesInfos {
      flex: 1;
      padding: 80px 0 0 50px;
    }
    .containerMesInfos .mesInfosSection {
      padding: 20px;
      width: 75%;
    }
    .containerMesInfos .mesInfosSection h2 {
      font-size: 1.6rem;
      color: var(--color_title);
      margin-bottom: 20px;
    }
    .containerMesInfos .mesInfosForm {
      max-width: 600px;
    }
    .containerMesInfos .mesInfosForm label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
    }
    .containerMesInfos .mesInfosForm input[type="text"],
    .containerMesInfos .mesInfosForm input[type="email"],
    .containerMesInfos .mesInfosForm select,
    .containerMesInfos .mesInfosForm input[type="password"] {
      width: 350px;
      height: 40px;
      padding: 8px 12px;
      border: 1px solid var(--border);
      border-radius: 4px;
      font-size: 1rem;
      margin-bottom: 20px;
    }

    .containerMesInfos .mesInfosForm input[type="email"],
    .containerMesInfos .mesInfosForm input[type="password"] {
        padding-left: 40px;
    }

    .containerMesInfos .inlineFields {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }
    .containerMesInfos .inlineFields .fieldGroup {
      display: flex;
      flex-direction: column;
    }

    .containerMesInfos .resetBtn {
      background-color: var(--color_btn);
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 16px;
      cursor: pointer;
      width: 250px;
      font-size: 1rem;
    }
    .containerMesInfos .resetBtn:hover {
      background-color: #1565C0;
    }
    @media screen and (max-width: 1080px) {
      .containerMesInfos {
        padding: 80px 20px 0 20px;
      }
      .containerMesInfos .inlineFields {
        display: block;
      }
      .containerMesInfos .inlineFields .fieldGroup {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>
  <?php include "../../includes/header2.php"; ?>
  <div class="flex">
    <?php include "../../includes/navBar/navBar1.php"; ?>
    <div class="containerMesInfos">
      <section class="mesInfosSection">
        <h2>Mes informations</h2>
        <form class="mesInfosForm">

          <div class="inlineFields">
            <div class="fieldGroup">
              <label for="lastName">Nom de famille</label>
              <input type="text" id="lastName" name="lastName" value="Martins" />
            </div>
            <div class="fieldGroup">
              <label for="firstName">Prénom</label>
              <input type="text" id="firstName" name="firstName" value="Jeff" />
            </div>
          </div>


          <label for="emailAddress">Adresse email</label>
          <input type="email" id="emailAddress" name="emailAddress" value="j.martins@mentalworks.fr" />


          <div class="inlineFields">
            <div class="fieldGroup">
              <label for="directionService">Direction/Service</label>
              <select id="directionService" name="directionService">
                <option value="BU Symfony" selected>BU Symfony</option>
                <option value="BU Marketing">BU Marketing</option>
                <option value="BU Applications mobiles">BU Applications mobiles</option>
                <option value="BU Wordpress">BU Wordpress</option>
              </select>
            </div>
            <div class="fieldGroup">
              <label for="poste">Poste</label>
              <select id="poste" name="poste">
                <option value="Directeur technique" selected>Directeur technique</option>
                <option value="Lead Développeur">Lead Développeur</option>
                <option value="Développeur Web">Développeur Web</option>
                <option value="Graphiste">Graphiste</option>
              </select>
            </div>
          </div>

          <label for="manager">Manager</label>
          <input type="text" id="manager" name="manager" value="Frédéric Salesse" readonly />

          <h2>Réinitialiser mon mot de passe</h2>
          <div class="inlineFields">
            <div class="fieldGroup">
              <label for="newPassword">Nouveau mot de passe</label>
              <input type="password" id="newPassword" name="newPassword" />
            </div>
            <div class="fieldGroup">
              <label for="confirmPassword">Confirmation mot de passe</label>
              <input type="password" id="confirmPassword" name="confirmPassword" />
            </div>
          </div>
          <button type="button" class="resetBtn">Réinitialiser le mot de passe</button>
        </form>
      </section>
    </div>
  </div>
</body>
</html>
