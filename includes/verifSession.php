<?php

if (empty($_SESSION['utilisateur'])) {
    header("Location : index.php");
} else if (isset($_SESSION['utilisateur']['role'])) {
    echo '<div class="messageSucces" id="messageSucces">' . 'Bienvenue ' . $_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom'] . '</div>';
}
?>

<script src="../script.js"></script>