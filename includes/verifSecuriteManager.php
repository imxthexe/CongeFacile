<?php
if (empty($_SESSION['utilisateur'])) {
    header("Location : index.php");
} else if ($_SESSION['utilisateur']['role'] == "collaborateur") {
    header(("Location :index.php"));
}
