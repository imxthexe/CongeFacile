<?php

session_start();

?>
<link
    rel="stylesheet" href="../../style.css">

<body>
    <input type="checkbox" id="checkbox">
    <label for="checkbox" class="toggle">
    </label>
    <div class="navBar">
        <div class="link">
            <nav>
                <ul>
                    <a href="../../pages/commun/accueil.php">
                        <li>Accueil</li>
                    </a>
                    <a href="../../pages/collaborateur/nouvelleDemande.php">
                        <li>Nouvelle demande</li>
                    </a>
                    <a href="../../pages/collaborateur/historiqueDesDemandes.php">
                        <li>Historique des demandes</li>
                    </a>
                </ul>
                <hr>
                <ul>
                    <a href="../../pages/collaborateur/mesInformation.php">
                        <li>Mes informations</li>
                    </a>
                    <a href="../../pages/collaborateur/mesPreferences.php">
                        <li>Mes préférences</li>
                    </a>
                    <a href="#">
                        <li>Deconnexion</li>
                    </a>
                </ul>
            </nav>
        </div>
        <div class="profile">
            <div class="img">
                <img src="https://placehold.co/60x60" alt="profile">
            </div>
            <div>
                <p class="name"><?php echo $_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom'] ?></p>
                <p class="role"><?= $_SESSION['utilisateur']['role'] ?></p>
            </div>
        </div>
    </div>
</body>