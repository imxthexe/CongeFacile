<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Effectuer une nouvelle demande</title>
  <link rel="stylesheet" href="../../style.css">

  <?php if ((!isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] != "collaborateur")) {
    header("Location : ../commun/connexion.php");
  } ?>

  <style>
    .page {
      flex: 1;
      padding: 80px 0 0 50px;
    }

    .page .nouvelleDemandeSection {
      padding: 20px;
      width: 75%;
    }

    .page .nouvelleDemandeSection h2 {
      font-size: 1.6rem;
      color: var(--color_title);
      margin-bottom: 30px;
    }

    .page .nouvelleDemandeForm {
      max-width: 600px;
    }

    .page .nouvelleDemandeForm label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
    }

    .page .nouvelleDemandeForm select,
    .page .nouvelleDemandeForm input[type="date"],
    .page .nouvelleDemandeForm input[type="file"],
    .page .nouvelleDemandeForm input[type="text"],
    .page .nouvelleDemandeForm input[type="number"],
    .page .nouvelleDemandeForm textarea {
      width: 350px;
      height: 40px;
      padding: 8px 12px;
      border: 1px solid var(--border);
      border-radius: 4px;
      font-size: 1rem;
      margin-bottom: 20px;
    }

    .nbJours {
      background-color: var(--border);
    }

    .page .nouvelleDemandeForm textarea {
      resize: none;
      min-height: 150px;
      width: 725px;
    }

    .page .inlineFields {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .page .inlineFields .fieldGroup {
      display: flex;
      flex-direction: column;
    }

    .page .submitBtn {
      background-color: var(--color_btn);
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 16px;
      cursor: pointer;
      width: 200px;
      display: block;
      margin-top: 20px;
    }

    .page .submitBtn:hover {
      background-color: #1565C0;
    }

    .ErrorP {
      margin: 20px 0;
    }

    @media screen and (max-width: 1080px) {
      .page {
        padding: 100px 20px 0 20px;
      }

      .page .inlineFields {
        display: block;
      }
    }
  </style>
</head>

<body>
  <?php include "../../includes/header2.php"; ?>
  <div class="flex">
    <?php include "../../includes/navBar/navBar1.php"; ?>
    <div class="page">
      <section class="nouvelleDemandeSection">
        <h2>Effectuer une nouvelle demande</h2>
        <form class="nouvelleDemandeForm">
          <label for="typeDemande">Type de demande</label>
          <select id="typeDemande" name="typeDemande" required>
            <option value="">Sélectionner un type</option>
            <option value="congePaye">Congé payé</option>
            <option value="congeSansSolde">Congé sans solde</option>
            <option value="congeMaladie">Congé maladie</option>
            <option value="autre">Autre</option>
          </select>

          <div class="inlineFields">
            <div class="fieldGroup">
              <label for="dateDebut">Date début</label>
              <input type="date" id="dateDebut" name="dateDebut" required />
            </div>
            <div class="fieldGroup">
              <label for="dateFin">Date de fin</label>
              <input type="date" id="dateFin" name="dateFin" required />
            </div>
          </div>

          <label for="nbJours">Nombre de jours demandés</label>
          <input class="nbJours" type="number" id="nbJours" name="nbJours" placeholder="0" require />

          <label for="justificatif">Justificatif si applicable</label>
          <input type="text" id="justificatif" name="justificatif" placeholder="Sélectionner un fichier" />
          <!-- je sais que le type est file mais sur le visuel j'arrrive pas a le changer donc fuck -->

          <label for="commentaire">Commentaire supplémentaire</label>
          <textarea id="commentaire" name="commentaire" placeholder="Si congé exceptionnel ou sans solde, vous pouvez préciser votre demande."></textarea>

          <button type="submit" class="submitBtn">Soumettre ma demande</button>
        </form>

        <p class="ErrorP">* En cas d'erreur de saisie ou de changement, vous poourrez moifier ovtre demande tant que celle-ci n'a pas été validée par le manager</p>

      </section>
    </div>
  </div>
</body>

</html>