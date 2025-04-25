<link
    rel="stylesheet" href="../../style.css">

<body>
    <!-- From Uiverse.io by vinodjangid07 -->
    <input type="checkbox" id="checkbox">
    <label for="checkbox" class="toggle">
        <div class="bars" id="bar1"></div>
        <div class="bars" id="bar2"></div>
        <div class="bars" id="bar3"></div>
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
                    <a href="../../deconnexion.php" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">
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