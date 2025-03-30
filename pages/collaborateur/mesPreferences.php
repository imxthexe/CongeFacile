<?php
session_start();
$titre = 'Historique des demandes';
include '../../includes/database.php';
include '../../includes/functions.php';

?>

<link rel="stylesheet" href="../../style.css">

<div class="flex">
  <?php include "../../includes/navBar/navBar1.php"; ?>
  <div class="page">
    <section class="preferencesSection">
      <h2>Mes préférences</h2>

      <div class="switchContainer">
        <label class="switchWrapper">
          <input type="checkbox" id="alertEmail" />
          <span class="slider"></span>
        </label>
        <label for="alertEmail" class="switchLabel">
          Être alerté par email lorsqu’une demande de congé est acceptée ou refusée
        </label>
      </div>

      <div class="switchContainer">
        <label class="switchWrapper">
          <input type="checkbox" id="rapport" />
          <span class="slider"></span>
        </label>
        <label for="rapport" class="switchLabel">
          Recevoir un rapport par email lorsqu’un congé arrive la semaine prochaine
        </label>
      </div>

      <button class="saveBtn" onclick="savePreferences()">Enregistrer mes préférences</button>
    </section>
  </div>
</div>

<script>
  function loadPreferences() {
    const alertEmail = localStorage.getItem("alertEmail") === "true";
    const rapport = localStorage.getItem("rapport") === "true";
    document.getElementById("alertEmail").checked = alertEmail;
    document.getElementById("rapport").checked = rapport;
  }

  function savePreferences() {
    const alertEmail = document.getElementById("alertEmail").checked;
    const rapport = document.getElementById("rapport").checked;
    localStorage.setItem("alertEmail", alertEmail);
    localStorage.setItem("rapport", rapport);
    alert("Préférences enregistrées !");
  }

  window.onload = loadPreferences;
</script>
</body>

</html>