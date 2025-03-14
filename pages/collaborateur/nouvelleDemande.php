<link rel="stylesheet" href="../../style.css">
<?php include'../../includes/header2.php'?>
<div class="Container-newdemande">
    
        <h1>Effectuer une nouvelle demande</1>
        <form>
            <label for="type">Type de demande - champ obligatoire</label>
            <select id="type" required>
                <option value="">Sélectionner un type</option>
                <option value="congé">Congé</option>
                <option value="absence">Absence</option>
            </select>
            <div class="datenewdemande">
                <label for="date_debut">Date début - champ obligatoire</label>
                <input type="date" id="date_debut" required>

                <label for="date_fin">Date de fin - champ obligatoire</label>
                <input type="date" id="date_fin" required>
            </div>

            <label for="jours">Nombre de jours demandés</label>
            <input type="number" id="jours" min="0" readonly>

            <label for="justificatif">Justificatif si applicable</label>
            <div class="file-input"><p>Sélectionner un fichier</p></div>
            <input type="file" id="justificatif" hidden>

            <label for="commentaire">Commentaire supplémentaire</label>
            <textarea id="commentaire" placeholder="Si congé exceptionnel ou sans solde, vous pouvez préciser votre demande."></textarea>

            <button type="submit">Soumettre ma demande</button>
        </form>
   
</div>