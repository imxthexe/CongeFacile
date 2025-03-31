<?php
session_start();
$titre = 'Historique des demandes';
include '../../includes/database.php';
include '../../includes/functions.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteCollaborateur.php';

?>

<link rel="stylesheet" href="../../style.css">



<div class="flex">
  <?php include "../../includes/navBar/navBar1.php"; ?>
  <div class="page">
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