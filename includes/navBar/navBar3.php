<link rel="stylesheet" href="../../style.css">

<body>
    <input type="checkbox" id="checkbox">
    <label for="checkbox" class="toggle">
    </label>
    <div class="navBar">
        <div class="link">
            <nav>
                <ul>
                    <a href="#">
                        <li>Accueil</li>
                    </a>
                    <a href="../../../pages/manager/demandesEnAttente.php">
                        <li>Demande en attente</li>
                    </a>
                    <a href="../../../pages/manager/historiqueDesDemandesEnAttente.php">
                        <li>Historique des demandes</li>
                    </a>
                    <a href="../../../pages/manager/monEquipe1.php">
                        <li>Mon équipe</li>
                    </a>
                    <a href="../../../pages/manager/statistiques.php">
                        <li>Statistiques</li>
                    </a>
                </ul>
                <hr>
                <ul>
                    <a href="../../../pages/manager/mesInformations.php">
                        <li>Mes informations</li>
                    </a>
                    <a href="../../../pages/manager/mesPreferences.php">
                        <li>Mes préférences</li>
                    </a>
                    <details>
                        <summary>
                            <li>Administration <img src="../../../images/fleche-vers-le-bas.png" alt=""></li>
                        </summary>
                        <ul>
                            <a href="../../../pages/administration/typesDeDemandes/typesDedemandes.php">
                                <li>Types de demandes</li>
                            </a>
                            <a href="../../../pages/administration/directionsServices/directionsServices.php">
                                <li>Directions/Services</li>
                            </a>
                            <a href="../../../pages/administration/managers/managers.php">
                                <li>Managers</li>
                            </a>
                            <a href="../../../pages/administration/postes/postes.php">
                                <li>Postes</li>
                            </a>
                        </ul>
                    </details>
                    <a href="../../../../deconnexion.php">
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