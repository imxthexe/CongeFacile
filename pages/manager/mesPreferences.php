<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mes préférences</title>
  <link rel="stylesheet" href="../../style.css" />
  <style>
    .containerPreferences {
      flex: 1;
      padding: 80px 0 0 50px;
    }
    .containerPreferences .preferencesSection {
      padding: 20px;
      width: 75%;
    }
    .containerPreferences .preferencesSection h2 {
      font-size: 1.6rem;
      color: var(--color_title);
      margin-bottom: 20px;
    }

    /* Style du toggle switch (même logique que le code précédent) */
    .switchContainer {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }
    .switchLabel {
      font-weight: 500;
      cursor: pointer;
    }
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

    .saveBtn {
      background-color: var(--color_btn);
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 16px;
      cursor: pointer;
      font-size: 1rem;
      width: 250px;
    }
    .saveBtn:hover {
      background-color: #1565C0;
    }

    @media screen and (max-width: 1080px) {
      .containerPreferences {
        padding: 80px 20px 0 20px;
      }
    }
  </style>
  <script>
    // Chargement des préférences depuis le localStorage
    function loadPreferences() {
      const alertEmail = localStorage.getItem("alertEmail") === "true";
      document.getElementById("alertEmail").checked = alertEmail;
    }

    // Sauvegarde des préférences dans le localStorage
    function savePreferences() {
      const alertEmail = document.getElementById("alertEmail").checked;
      localStorage.setItem("alertEmail", alertEmail);
      alert("Préférences enregistrées !");
    }

    window.onload = loadPreferences;
  </script>
</head>
<body>
  <?php include "../../includes/header2.php"; ?>
  <div class="flex">
    <?php include "../../includes/navBar/navBar1.php"; ?>
    <div class="containerPreferences">
      <section class="preferencesSection">
        <h2>Mes préférences</h2>

        <div class="switchContainer">
          <label class="switchWrapper">
            <input type="checkbox" id="alertEmail" />
            <span class="slider"></span>
          </label>
          <label for="alertEmail" class="switchLabel">
            Être alerté par email lorsqu’une demande de congé arrive
          </label>
        </div>

        <button class="saveBtn" onclick="savePreferences()">Enregistrer mes préférences</button>
      </section>
    </div>
  </div>
</body>
</html>
