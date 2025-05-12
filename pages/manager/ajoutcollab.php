<?php
session_start();
$titre = 'Ajouter un collaborateur';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    // Validations
    if (empty($data['last_name'])) $errors['last_name'] = 'Nom requis';
    if (empty($data['first_name'])) $errors['first_name'] = 'Prénom requis';
    if (empty($data['email'])) $errors['email'] = 'Email requis';
    if (empty($data['password'])) $errors['password'] = 'Mot de passe requis';
    if ($data['password'] !== $data['confirm_password']) $errors['confirm_password'] = 'Les mots de passe ne correspondent pas';

    // Vérification email existant
    $checkEmail = $bdd->prepare("SELECT id FROM user WHERE email = :email");
    $checkEmail->execute(['email' => $data['email']]);
    if ($checkEmail->fetch()) $errors['email'] = 'Cet email est déjà utilisé';

    if (empty($errors)) {
        try {
            $bdd->beginTransaction();

            // Insert into person
            $insertPerson = $bdd->prepare("
                INSERT INTO person (last_name, first_name, department_id, position_id, manager_id)
                VALUES (:last_name, :first_name, :department_id, :position_id, :manager_id)
            ");
            $insertPerson->execute([
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'department_id' => $data['department_id'],
                'position_id' => $data['position_id'],
                'manager_id' => $data['manager_id']
            ]);
            $person_id = $bdd->lastInsertId();

            // Insert into user
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $insertUser = $bdd->prepare("
                INSERT INTO user (person_id, email, password)
                VALUES (:person_id, :email, :password)
            ");
            $insertUser->execute([
                'person_id' => $person_id,
                'email' => $data['email'],
                'password' => $hashedPassword
            ]);

            $bdd->commit();
            header('Location: monEquipe1.php');
            exit;

        } catch (Exception $e) {
            $bdd->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>

<link rel="stylesheet" href="../../style.css">

<div class="flex">
    <?php include "../../includes/navBar/navBar3.php"; ?>
    <div class="containerajout page">
        <section class="ajout">
            <h1>Ajouter un collaborateur</h1>
            <form class="editajoutForm" method="POST">
                <label>Nom</label>
                <input type="text" name="last_name" value="<?= afficheValeur('last_name', $data) ?>">
                <?= afficheErreur('last_name', $errors) ?>

                <label>Prénom</label>
                <input type="text" name="first_name" value="<?= afficheValeur('first_name', $data) ?>">
                <?= afficheErreur('first_name', $errors) ?>

                <label>Email</label>
                <input type="email" name="email" value="<?= afficheValeur('email', $data) ?>">
                <?= afficheErreur('email', $errors) ?>

                <label>Mot de passe</label>
                <input type="password" name="password">
                <?= afficheErreur('password', $errors) ?>

                <label>Confirmer mot de passe</label>
                <input type="password" name="confirm_password">
                <?= afficheErreur('confirm_password', $errors) ?>

                <label>Département</label>
                <select name="department_id">
                    <option value="1">BU Symfony</option>
                    <option value="2">BU Wordpress</option>
                </select>

                <label>Poste</label>
                <select name="position_id">
                    <option value="1">Marketing</option>
                    <option value="2">Développement Web</option>
                </select>

                <label>Manager</label>
                <select name="manager_id">
                    <option value="1">Frédéric Salesse</option>
                    <option value="2">Olivier Salesse</option>
                </select>

                <div class="actionButtons">
                    <button type="submit" class="updateBtn">Ajouter</button>
                </div>
            </form>
        </section>
    </div>
</div>
</body>
</html>
