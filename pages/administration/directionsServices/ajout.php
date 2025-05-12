<?php
session_start();
$titre = 'Ajouter un nouveau service';
include '../../../includes/database.php';
include '../../../includes/header3.php';
include '../../../includes/functions.php';

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $recupServices = $bdd->prepare('SELECT name FROM department');
    $recupServices->execute();
    $Services = $recupServices->fetchAll(PDO::FETCH_ASSOC);

    if (empty($data['nomService'])) {
        $errors['nomService'] = 'Veuillez renseigner un nom de service';
    }

    foreach ($Services as $Service) {
        if ($data['nomService'] == $Service['name']) {
            $errors['nomService'] = "Ce service existe déjà dans la base de données";
        }
    }

    if (empty($errors)) {
        $nouveauService = $bdd->prepare('INSERT INTO department VALUES (0,:nomService)');
        $nouveauService->bindParam(':nomService', $data['nomService']);
        $nouveauService->execute();
        $_SESSION['success_message'] = 'Le service a été ajouté avec succès.';
        header('Location: directionsServices.php');
        exit();
    }
}
?>

<link rel="stylesheet" href="../../../style.css">

<style>
    .containerBuSymfony {
        flex: 1;
        padding: 150px 0 0 350px;
    }

    .containerBuSymfony .buSymfony {
        padding: 20px;
        width: 75%;
    }

    .containerBuSymfony .buSymfony h2 {
        font-size: 1.6rem;
        color: var(--color_title);
        margin-bottom: 30px;
    }

    .containerBuSymfony .editBuSymfonyForm {
        max-width: 400px;
    }

    .containerBuSymfony .editBuSymfonyForm label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .containerBuSymfony .editBuSymfonyForm input[type="text"] {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid var(--border);
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 1rem;
    }

    .containerBuSymfony .actionButtons {
        display: flex;
        gap: 10px;
    }

    .containerBuSymfony .deleteBtn {
        background-color: #e74c3c;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
    }

    .containerBuSymfony .deleteBtn:hover {
        background-color: #c0392b;
    }

    .containerBuSymfony .updateBtn {
        background-color: var(--color_btn);
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
    }

    .containerBuSymfony .updateBtn:hover {
        background-color: #1565C0;
    }

    @media screen and (max-width: 1080px) {
        .containerBuSymfony .containerBuSymfony {
            padding: 100px 20px 0 20px;
        }
    }
</style>
</head>

<body>
    <?php include "../../../includes/header.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar1.php"; ?>

        <div class="containerBuSymfony">
            <section class="buSymfony">

                <h2>Ajouter un nouveau service</h2>

                <form class="editBuSymfonyForm" method="POST">
                    <label for="nomService">Nom du service</label>
                    <?php echo afficheErreur('nomService', $errors); ?>
                    <input
                        type="text"
                        id="nomService"
                        name="nomService"
                        placeholder="Service..."
                        value="<?php echo afficheValeur('nomService', $data) ?>" />

                    <div class="actionButtons">
                        <button type="submit" class="updateBtn">Ajouter</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</body>

</html>