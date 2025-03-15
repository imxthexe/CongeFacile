<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administration - Utilisateurs</title>

  <link rel="stylesheet" href="../../../style.css">

  <style>
    /* CONTAINER PRINCIPAL */
    .containerUser {
      flex: 1;
      padding: 150px 0 0 50px;
    }
    /* HEADER DE SECTION (TITRE + BOUTON) */
    .headerRow {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .headerRow h2 {
      margin: 0;
      font-size: 1.6rem;
      color: var(--color_title);
    }
    .addUserButton {
      background-color: var(--color_btn);
      color: #fff;
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-left: 20px;
      width: 150px;
    }
    .addUserButton:hover {
      background-color: #1565C0;
    }
    /* SECTION ADMINISTRATION */
    .administration {
      padding: 20px;
      width: 75%;
    }
    /* TABLEAU DES UTILISATEURS */
    .usersTable {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      background-color: #fff;
      border: 1px solid var(--border);
    }
    .usersTable thead {
      background-color: var(--border);
    }
    .usersTable thead th {
      text-align: left;
      padding: 12px 0 12px 16px;
      border: none;
    }
    /* Les bordures internes uniquement en horizontale */
    .usersTable tbody tr {
      border-bottom: 1px solid #ccc;
    }
    .usersTable tbody tr:last-child {
      border-bottom: none;
    }
    .usersTable td {
      text-align: left;
      padding: 12px 16px;
      border: none;
    }
    /* FILTRE DANS THEAD */
    .filtersRow input {
      padding: 4px 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 0.9rem;
      color: #fff;
      background-color: transparent;
    }
    /* Largeur des inputs */
    .filterName {
      width: 100%;
      margin-right: 200px;
    }
    .filterEmail {
      width: 45%;
    }
    .filterRole {
      width: 45%;
    }
    /* BOUTON DÉTAILS */
    .detailsButton {
      background-color: var(--border);
      color: #333;
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .detailsButton:hover {
      background-color: #bbb;
    }
    /* RESPONSIVE */
    @media screen and (max-width: 1080px) {
      .usersTable thead {
        display: none;
      }
      .usersTable tbody tr {
        display: block;
        margin-bottom: 15px;
        border: 1px solid #ddd;
      }
      .usersTable tbody td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
      }
      .usersTable tbody td::before {
        content: attr(data-label);
        font-weight: bold;
      }
      .addUserButton {
        width: 100%;
        margin-left: 0;
        margin-top: 10px;
      }
      .headerRow {
        display: block;
      }
    }
  </style>
</head>
<body>
  <?php include "../../../includes/header.php"; ?>

  <div class="flex">
    <?php include "../../../includes/navBar/navBar1.php"; ?>

    <div class="containerUser">
      <section class="administration">
        <div class="headerRow">
          <h2>Utilisateurs</h2>
          <button class="addUserButton">Ajouter un utilisateur</button>
        </div>

        <table class="usersTable">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Email</th>
              <th>Rôle</th>
              <th></th>
            </tr>
            <tr class="filtersRow">
              <th><input type="text" class="filterName" placeholder="Rechercher un nom" /></th>
              <th><input type="text" class="filterEmail" placeholder="Rechercher un email" /></th>
              <th><input type="text" class="filterRole" placeholder="Rechercher un rôle" /></th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td data-label="Nom">Jean Dupont</td>
              <td data-label="Email">jean.dupont@example.com</td>
              <td data-label="Rôle">Administrateur</td>
              <td><button class="detailsButton">Détails</button></td>
            </tr>
            <tr>
              <td data-label="Nom">Marie Curie</td>
              <td data-label="Email">marie.curie@example.com</td>
              <td data-label="Rôle">Éditeur</td>
              <td><button class="detailsButton">Détails</button></td>
            </tr>
            <tr>
              <td data-label="Nom">Paul Martin</td>
              <td data-label="Email">paul.martin@example.com</td>
              <td data-label="Rôle">Utilisateur</td>
              <td><button class="detailsButton">Détails</button></td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
  </div>
</body>
</html>
