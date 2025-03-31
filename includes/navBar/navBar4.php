<link rel="stylesheet" href="../../style.css">

<body>
    <input type="checkbox" id="checkbox">
    <label for="checkbox" class="toggle">
    </label>
    <div class="navBar">
        <div class="link">
            <nav>
                <ul>
                    <a href="../../pages/commun/index.php">
                        <li>Connexion</li>
                    </a>
                </ul>
            </nav>
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