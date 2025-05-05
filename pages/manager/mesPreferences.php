<?php
session_start();
$titre = 'Mes préférences';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';

?>
<link rel="stylesheet" href="../../style.css" />


<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerPreferences page">
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
<script>
  function loadPreferences() {
    const alertEmail = localStorage.getItem("alertEmail") === "true";
    document.getElementById("alertEmail").checked = alertEmail;
  }


  function savePreferences() {
    const alertEmail = document.getElementById("alertEmail").checked;
    localStorage.setItem("alertEmail", alertEmail);
    alert("Préférences enregistrées !");
  }

  window.onload = loadPreferences;
</script>
</body>

</html>