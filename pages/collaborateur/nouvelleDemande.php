<?php
session_start();
$titre = 'Nouvelle demande';

include "../../includes/database.php";
include "../../includes/header2.php";
include "../../includes/functions.php";
include '../../includes/verifSecuriteCollaborateur.php';

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = $_POST;

  $RequeteRecupRequest_typeID = $bdd->prepare('SELECT id FROM request_type WHERE name=:name');
  $RequeteRecupRequest_typeID->bindParam(':name', $data['typeDemande']);
  $RequeteRecupRequest_typeID->execute();
  $idRequest_type = $RequeteRecupRequest_typeID->fetch(PDO::FETCH_ASSOC);

  $RequeteRecupDepartment_ID = $bdd->prepare('SELECT department_id FROM person where id=:id');
  $RequeteRecupDepartment_ID->bindParam(':id', $_SESSION['utilisateur']['id']);
  $RequeteRecupDepartment_ID->execute();
  $RecupDepartment_ID = $RequeteRecupDepartment_ID->fetch(PDO::FETCH_ASSOC);

  $data['dateDebut'] = trim($data['dateDebut']);
  $data['dateFin'] = trim($data['dateFin']);
  $data['nbJours'] = trim($data['nbJours']);

  $data['dateDebut'] = htmlspecialchars($data['dateDebut']);
  $data['dateFin'] = htmlspecialchars($data['dateFin']);
  $data['nbJours'] = htmlspecialchars($data['nbJours']);

  if (isset($data['commentaire'])) {
    $data['typeDemande'] = trim($data['typeDemande']);
    $data['commentaire'] = htmlspecialchars($data['commentaire']);
  }

  if (empty($data['typeDemande'])) {
    $errors['typeDemande'] = 'Veuillez renseigner le type de votre demande';
  } else if (filter_var($data['typeDemande'], FILTER_VALIDATE_INT) === true) {
    $errors['typeDemande'] = 'Votre type de demande est incorrect';
  }

  if (empty($data['dateDebut'])) {
    $errors['dateDebut'] = 'Veuillez renseigner votre premier jour de congé';
  }

  if (empty($data['dateFin'])) {
    $errors['dateFin'] = 'Veuillez renseigner votre dernier jour de congé';
  }

  if (empty($data['nbJours'])) {
    $errors['nbJours'] = 'Veuillez renseigner la durée de votre congé ci-dessus';
  } else if (filter_var($data['nbJours'], FILTER_VALIDATE_INT) === false) {
    $errors['nbJours'] = 'Durée du congé incorrecte';
  }

  $date = date("Y-m-d H:i:s");
  $collaborateurId = $_SESSION['utilisateur']['id'];
  $request_typeID = $idRequest_type['id'];
  $department_id = $RecupDepartment_ID['department_id'];

  $requeteNouvelleDemande = $bdd->prepare("INSERT INTO request 
    (request_type_id, collaborator_id, department_id, created_at, start_at, end_at, receipt_file, answer_comment, answer, answer_at) 
    VALUES (:request_type_id, :collaborator_id, :department_id, :created_at, :start_at, :end_at, :receipt_file, :answer_comment, NULL, :answer_at)");
  $requeteNouvelleDemande->bindParam(':request_type_id', $request_typeID);
  $requeteNouvelleDemande->bindParam(':collaborator_id', $collaborateurId);
  $requeteNouvelleDemande->bindParam(':department_id', $department_id);
  $requeteNouvelleDemande->bindParam(':created_at', $date);
  $requeteNouvelleDemande->bindParam(':start_at', $data['dateDebut']);
  $requeteNouvelleDemande->bindParam(':end_at', $data['dateFin']);
  $requeteNouvelleDemande->bindValue(':receipt_file', null, PDO::PARAM_NULL);
  $requeteNouvelleDemande->bindValue(':answer_comment', null, PDO::PARAM_NULL);
  $requeteNouvelleDemande->bindValue(':answer_at', null, PDO::PARAM_NULL);
  $requeteNouvelleDemande->execute();
}




?>




<div class="flex">
  <?php include "../../includes/navBar/navBar1.php"; ?>
  <div class="ContainerNouvelleDemande page">
    <section class="nouvelleDemandeSection">
      <h2>Effectuer une nouvelle demande</h2>
      <form class="nouvelleDemandeForm" method="POST">
        <label for="typeDemande">Type de demande</label>
        <select id="typeDemande" name="typeDemande" required value="<?php afficheValeur('typeDemande', $data) ?>">
          <option value="">Sélectionner un type</option>
          <option value="Congé payé">Congé payé</option>
          <option value="Congé sans solde">Congé sans solde</option>
          <option value="Congé maladie">Congé maladie</option>
        </select>
        <?php afficheErreur('typeDemande', $errors) ?>

        <div class="inlineFields">
          <div class="fieldGroup">
            <label for="dateDebut">Date début</label>
            <input type="date" id="dateDebut" name="dateDebut" required value="<?php afficheValeur('dateDebut', $data) ?>" />
            <?php afficheErreur('dateDebut', $errors) ?>
          </div>
          <div class="fieldGroup">
            <label for="dateFin">Date de fin</label>
            <input type="date" id="dateFin" name="dateFin" required value="<?php afficheValeur('dateFin', $data) ?>" />
            <?php afficheErreur('dateFin', $errors) ?>
          </div>
        </div>

        <label for="nbJours">Nombre de jours demandés</label>
        <input class="nbJours" type="number" id="nbJours" name="nbJours" placeholder="0" required value="<?php afficheValeur('nbJours', $data) ?>" />
        <?php afficheErreur('nbJours', $errors) ?>

        <label for="justificatif">Justificatif si applicable</label>
        <input type="file" id="justificatif" name="justificatif" value="Sélectionner un fichier" />

        <label for="commentaire">Commentaire supplémentaire</label>
        <textarea id="commentaire" name="commentaire" placeholder="Si congé exceptionnel ou sans solde, vous pouvez préciser votre demande."></textarea>

        <input type="submit" class="submitBtn" value="Soumettre ma demande" />
      </form>

      <p class="ErrorP">* En cas d'erreur de saisie ou de changement, vous pourrez modifier votre demande tant que celle-ci n'a pas été validée par le manager</p>

    </section>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const dateDebut = document.getElementById("dateDebut");
    const dateFin = document.getElementById("dateFin");
    const nbJours = document.getElementById("nbJours");

    function calculerNbJours() {
      const debut = new Date(dateDebut.value);
      const fin = new Date(dateFin.value);

      if (!isNaN(debut) && !isNaN(fin) && fin >= debut) {
        const difference = Math.ceil((fin - debut) / (1000 * 60 * 60 * 24));
        nbJours.value = difference;
      } else {
        nbJours.value = 0;
      }
    }

    dateDebut.addEventListener("change", calculerNbJours);
    dateFin.addEventListener("change", calculerNbJours);
  });
</script>
<?php
include '../../includes/footer.php';

?>