<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';

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
          value="salesse@mentalworks.fr"
          required />

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="lastName">Nom de famille - champ obligatoire</label>
            <input
              type="text"
              id="lastName"
              name="lastName"
              value="Salesse"
              required />
          </div>
          <div class="fieldGroup">
            <label for="firstName">Prénom - champ obligatoire</label>
            <input
              type="text"
              id="firstName"
              name="firstName"
              value="Frédéric"
              required />
          </div>
        </div>

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="directionService">Direction/Service - champ obligatoire</label>
            <select id="directionService" name="directionService" required>
              <option value="BU Symfony" selected>BU Symfony</option>
              <option value="BU Wordpress">BU Wordpress</option>
              <option value="BU Applications mobiles">BU Applications mobiles</option>
              <option value="BU Marketing">BU Marketing</option>
            </select>
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

        <label for="manager">Manager</label>
        <input
          type="text"
          id="manager"
          name="manager"
          value="Frédéric Salesse"
          readonly />

        <h2>Réinitialiser mon mot de passe</h2>

        <label for="currentPassword">Mot de passe actuel</label>
        <input
          type="password"
          id="currentPassword"
          name="currentPassword" />

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

        <button type="button" class="resetBtn">Réinitialiser le mot de passe</button>
      </form>
    </section>
  </div>
</div>
</body>

</html>