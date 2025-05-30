<?php
session_start();
$titre = 'Informations Manager';
include '../../../includes/database.php';
include "../../../includes/header3.php";
include '../../../includes/functions.php';
include '../../../includes/verifSecuriteManager.php';

$id = $_GET['id'];
$RecupInfosManager = $bdd->prepare("SELECT 
    u.email,
    u.password,
    p.last_name AS nom,
    p.first_name AS prenom,
    d.name AS department
FROM 
    user u
JOIN 
    person p ON u.person_id = p.id
JOIN 
    department d ON p.department_id = d.id
WHERE 
    u.role = 'manager' AND u.id = :id");

$RecupInfosManager->bindParam(':id', $id);
$RecupInfosManager->execute();
$infosManagers = $RecupInfosManager->fetch(PDO::FETCH_ASSOC);


$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $data['newPassword'] = trim($data['newPassword']);
    $data['confirmPassword'] = trim($data['confirmPassword']);


    $data['newPassword'] = htmlspecialchars($data['newPassword']);
    $data['confirmPassword'] = htmlspecialchars($data['confirmPassword']);



    if (empty($data['newPassword'])) {
        $errors['newPassword'] = "Veuillez rentrer votre nouveau mot de passe";
    }

    if ($data['newPassword'] !== $data['confirmPassword']) {
        $errors['newPassword'] = "Les deux mots de passe ne correspondent pas.";
    }

    if (empty($data['confirmPassword'])) {
        $errors['confirmPassword'] = "Rentrez votre nouveau mot de passe";
    }



    if (empty($errors)) {
        $id = $_SESSION['utilisateur']['id'];
        $password = password_hash($data['newPassword'], PASSWORD_DEFAULT);
        $updateMdp = $bdd->prepare("UPDATE user SET password = :password WHERE id = :id");
        $updateMdp->bindParam(':password', $password);
        $updateMdp->bindParam(':id', $id);
        $updateMdp->execute();
        $_SESSION['success_message'] = 'Votre mot de passe a été modifié avec succès.';
        header('Location: modifications.php');
        exit();
    }
}

?>

<link rel="stylesheet" href="../../../style.css">

<style>
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>
<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>
    <div class="containerMesInfos page">
        <section class="mesInfosSection">
            <h2>Mes informations</h2>
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="success-message">
                    <?php echo $_SESSION['success_message']; ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>
            <form class="mesInfosForm" method="POST">
                <label for="emailAddress">Adresse email - champ obligatoire</label>
                <input
                    type="email"
                    id="emailAddress"
                    name="emailAddress"
                    value="<?php echo $infosManagers['email'] ?>"
                    required readonly />

                <div class="inlineFields">
                    <div class="fieldGroup">
                        <label for="lastName">Nom de famille - champ obligatoire</label>
                        <input
                            type="text"

                            value="<?= $infosManagers['nom'] ?>"
                            required readonly />
                    </div>
                    <div class="fieldGroup">
                        <label for="firstName">Prénom - champ obligatoire</label>
                        <input
                            type="text"

                            value="<?= $infosManagers['prenom'] ?>"
                            required readonly />
                    </div>
                </div>

                <div class="inlineFields">
                    <div class="fieldGroup">
                        <label for="directionService">Direction/Service - champ obligatoire</label>

                        <select name="department" id="department">
                            <option value="<?= $infosManagers['department'] ?>">
                                <?= $infosManagers['department'] ?>
                            </option>
                        </select>
                    </div>

                </div>


                <input type="submit" value="Il est impossible de modifier les informations d'un autre manager." readonly></button>
            </form>
        </section>
    </div>
</div>



</html>