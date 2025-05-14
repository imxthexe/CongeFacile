<?php
session_start();
$titre = 'Ajouter un nouveau manager';
include '../../../includes/database.php';
include '../../../includes/header3.php';
include '../../../includes/functions.php';

$errors = [];
$data = [];
$RegexMDP = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (empty($data['managerEmail'])) {
        $errors['managerEmail'] = 'Veuillez renseigner une adresse email';
    } elseif (filter_var($data['managerEmail'], FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Votre email est incorrect';
    }
    if (empty($data['managerLastName'])) {
        $errors['managerLastName'] = 'Veuillez renseigner un nom de famille';
    }

    if (empty($data['managerFirstName'])) {
        $errors['managerFirstName'] = 'Veuillez renseigner un prénom';
    }

    if (empty($data['managerDirection'])) {
        $errors['managerDirection'] = 'Veuillez sélectionner une direction/service';
    }

    if (empty($data['managerNewPassword'])) {
        $errors['managerNewPassword'] = 'Veuillez renseigner un mot de passe';
    }

    if ($data['managerNewPassword'] !== $data['managerConfirmPassword']) {
        $errors['managerConfirmPassword'] = 'Les mots de passe ne correspondent pas';
    }

    if (!preg_match($RegexMDP, $data['managerNewPassword'])) {
        $errors['managerNewPassword'] = "Votre mot de passe doit contenir au minimum 8 caractères, 1 lettre majuscule, 1 chiffre et 1 caractère spécial";
    }


    if (empty($errors)) {

        $checkEmail = $bdd->prepare('SELECT id FROM user WHERE email = :email');
        $checkEmail->bindParam(':email', $data['managerEmail']);
        $checkEmail->execute();

        if ($checkEmail->rowCount() > 0) {
            $errors['managerEmail'] = 'Cette adresse email est déjà utilisée';
        } else {

            $recupPosition = $bdd->prepare('SELECT id FROM positions WHERE name = :positionName');
            $recupPosition->bindValue(':positionName', 'Manager');
            $recupPosition->execute();
            $position = $recupPosition->fetch(PDO::FETCH_ASSOC);




            if (!$position) {
                $insertPosition = $bdd->prepare('INSERT INTO positions (name) VALUES (:positionName)');
                $insertPosition->bindValue(':positionName', 'Manager');
                $insertPosition->execute();
                $positionId = $bdd->lastInsertId();
            } else {
                $positionId = $position['id'];
            }

            $insertPerson = $bdd->prepare('INSERT INTO person (last_name, first_name, department_id, position_id) 
                                        VALUES (:lastName, :firstName, 
                                        (SELECT id FROM department WHERE name = :department), :position_id)');
            $insertPerson->bindParam(':lastName', $data['managerLastName']);
            $insertPerson->bindParam(':firstName', $data['managerFirstName']);
            $insertPerson->bindParam(':department', $data['managerDirection']);
            $insertPerson->bindParam(':position_id', $positionId);
            $insertPerson->execute();
            $personId = $bdd->lastInsertId();


            $password = password_hash($data['managerNewPassword'], PASSWORD_DEFAULT);
            $insertUser = $bdd->prepare('INSERT INTO user (email, password, role, person_id) 
                                        VALUES (:email, :password, :role, :person_id)');
            $insertUser->bindParam(':email', $data['managerEmail']);
            $insertUser->bindParam(':password', $password);
            $insertUser->bindValue(':role', 'manager');
            $insertUser->bindParam(':person_id', $personId);
            $insertUser->execute();

            $_SESSION['success_message'] = 'Le manager a été ajouté avec succès.';
            header('Location: managers.php');
            exit();
        }
    }
}
?>


<link rel="stylesheet" href="../../../style.css">
<style>
    .password-container {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 35%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .inlineFields {
        margin-top: 50px;
    }

    #managerNewPassword,
    #managerConfirmPassword {
        justify-content: center;
    }
</style>


<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerManagerDetail page">
        <section class="managerDetail">
            <h2>Ajouter un manager</h2>

            <form class="managerEditForm" method="POST">
                <label for="managerEmail">Adresse email - champ obligatoire</label>
                <input
                    type="email"
                    id="managerEmail"
                    name="managerEmail"
                    value="<?php if (isset($data["managerEmail"])) {
                                echo htmlspecialchars($data['managerEmail']);
                            } ?>"
                    required />
                <?php echo afficheErreur('managerEmail', $errors); ?>

                <div class="inlineFields">
                    <div class="fieldGroup">
                        <label for="managerLastName">Nom de famille - champ obligatoire</label>
                        <input
                            type="text"
                            id="managerLastName"
                            name="managerLastName"
                            value="<?php if (isset($data["managerLastName"])) {
                                        echo htmlspecialchars($data['managerLastName']);
                                    } ?>"
                            required />
                        <?php echo afficheErreur('managerLastName', $errors); ?>
                    </div>
                    <div class="fieldGroup">
                        <label for="managerFirstName">Prénom - champ obligatoire</label>
                        <input
                            type="text"
                            id="managerFirstName"
                            name="managerFirstName"
                            value="<?php if (isset($data["managerFisrtName"])) {
                                        echo htmlspecialchars($data['managerFirstName']);
                                    } ?>"
                            required />
                        <?php echo afficheErreur('managerFirstName', $errors); ?>
                    </div>
                </div>

                <label for="managerDirection">Direction/Service - champ obligatoire</label>
                <select
                    id="managerDirection"
                    name="managerDirection"
                    required>
                    <option value="BU Symfony" selected>Sélectionner un service qui ne possède pas de manager</option>
                    <?php
                    $recupDepartements = $bdd->prepare('SELECT d.* FROM department d WHERE d.id NOT IN (SELECT DISTINCT p.department_id FROM person p WHERE p.manager_id IS NULL) ORDER BY name');
                    $recupDepartements->execute();
                    while ($departement = $recupDepartements->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'  . htmlspecialchars($departement['name']) . '">' . htmlspecialchars($departement['name']) . '</option>';
                    }
                    ?>
                </select>
                <?php echo afficheErreur('managerDirection', $errors); ?>

                <div class="inlineFields">
                    <div class="fieldGroup">
                        <label for="managerNewPassword">Nouveau mot de passe</label>
                        <div class="password-container">
                            <input
                                type="password"
                                id="managerNewPassword"
                                name="managerNewPassword" />
                            <span class="toggle-password">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        <?php echo afficheErreur('managerNewPassword', $errors); ?>
                    </div>
                    <div class="fieldGroup">
                        <label for="managerConfirmPassword">Confirmation de mot de passe</label>
                        <div class="password-container">
                            <input
                                type="password"
                                id="managerConfirmPassword"
                                name="managerConfirmPassword" />
                            <span class="toggle-password">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        <?php echo afficheErreur('managerConfirmPassword', $errors); ?>
                    </div>
                </div>

                <input type="hidden" name="managerPosition" value="Manager" />

                <button type="submit" class="managerUpdateBtn">Ajouter un nouveau manager</button>
            </form>
        </section>
    </div>

</div>

<script>
    const toggleNewPassword = document.getElementById("toggleNewPassword");
    const newPasswordInput = document.getElementById("managerNewPassword");

    toggleNewPassword.addEventListener("click", function() {
        const type = newPasswordInput.getAttribute("type") === "password" ? "text" : "password";
        newPasswordInput.setAttribute("type", type);


        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });

    const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
    const confirmPasswordInput = document.getElementById("managerConfirmPassword");

    toggleConfirmPassword.addEventListener("click", function() {
        const type = confirmPasswordInput.getAttribute("type") === "password" ? "text" : "password";
        confirmPasswordInput.setAttribute("type", type);

        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });
</script>

</body>

</html>