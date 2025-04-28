<link rel="stylesheet" href="../../style.css">

<body>
    <input type="checkbox" id="checkbox">
    <label for="checkbox" class="toggle">
        <div id="bar1" class="bars"></div>
        <div id="bar2" class="bars"></div>
        <div id="bar3" class="bars"></div>
    </label>
    <div class="navBar">
        <div class="link">
            <nav>
                <ul>
                    <a href="#">
                        <li>Accueil</li>
                    </a>
                    <a href="../../pages/manager/demandesEnAttente.php">
                        <li>Demande en attente</li>
                    </a>
                    <a href="../../pages/manager/historiqueDesDemandesEnAttente.php">
                        <li>Historique des demandes</li>
                    </a>
                    <a href="../../pages/manager/monEquipe1.php">
                        <li>Mon équipe</li>
                    </a>
                    <a href="../../pages/manager/statistiques.php">
                        <li>Statistiques</li>
                    </a>
                </ul>
                <hr>
                <ul>
                    <a href="../../pages/manager/mesInformations.php">
                        <li>Mes informations</li>
                    </a>
                    <a href="../../pages/manager/mesPreferences.php">
                        <li>Mes préférences</li>
                    </a>
                    <details>
                        <summary>
                            <li>Administration <img src="../../images/fleche-vers-le-bas.png" alt=""></li>
                        </summary>
                        <ul>
                            <a href="../../pages/administration/typesDeDemandes/typesDedemandes.php">
                                <li>Types de demandes</li>
                            </a>
                            <a href="../../pages/administration/directionsServices/directionsServices.php">
                                <li>Directions/Services</li>
                            </a>
                            <a href="../../pages/administration/managers/managers.php">
                                <li>Managers</li>
                            </a>
                            <a href="../../pages/administration/postes/postes.php">
                                <li>Postes</li>
                            </a>
                        </ul>
                    </details>
                    <a href="../../deconnexion.php" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">
                        <li>Déconnexion</li>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll("a");
            const currentPage = window.location.href;

            // Vérifier si un lien actif est stocké
            let activeLink = localStorage.getItem("activeLink");

            // Supprimer les classes actives de tous les liens
            links.forEach(link => link.classList.remove("active-link"));

            // Si un lien a été précédemment cliqué, on lui remet la classe active
            if (activeLink) {
                links.forEach(link => {
                    if (link.href === activeLink) {
                        link.classList.add("active-link");
                    }
                });
            }

            // Ajouter la classe active au lien de la page actuelle
            links.forEach(link => {
                if (link.href === currentPage) {
                    link.classList.add("active-link");
                    localStorage.setItem("activeLink", link.href); // Mettre à jour le stockage
                }

                // Enregistrer le lien cliqué dans localStorage
                link.addEventListener("click", function() {
                    localStorage.setItem("activeLink", this.href);
                });
            });
        });
    </script>


</body>