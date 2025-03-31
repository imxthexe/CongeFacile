<?php

if (empty($_SESSION['utilisateur'])) {
    header("Location : index.php");
} else if (isset($_SESSION['utilisateur']['role'])) {
    echo '<div class="messageSuccès">' . 'Bienvenue ' . $_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom'] . '</div>';
}
