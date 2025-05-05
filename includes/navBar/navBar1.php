<link
    rel="stylesheet" href="../../style.css">

<body>
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
                        <li>Déconnexion</li>
                    </a>
                </ul>
            </nav>
        </div>
        <div class="profile">
            <div class="img">
                <img src="../../images/Capture d'écran 2025-05-05 100406.png" alt="profile">
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


            let activeLink = localStorage.getItem("activeLink");


            links.forEach(link => link.classList.remove("active-link"));


            if (activeLink) {
                links.forEach(link => {
                    if (link.href === activeLink) {
                        link.classList.add("active-link");
                    }
                });
            }


            links.forEach(link => {
                if (link.href === currentPage) {
                    link.classList.add("active-link");
                    localStorage.setItem("activeLink", link.href);
                }

                e
                link.addEventListener("click", function() {
                    localStorage.setItem("activeLink", this.href);
                });
            });
        });
    </script>



</body>