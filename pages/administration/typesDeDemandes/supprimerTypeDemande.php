<?php

include '../../../includes/database.php';
$id = $_GET['id'];

$SuppressionTypeDemande = $bdd->prepare('DELETE FROM request_type WHERE id=:id');
$SuppressionTypeDemande->bindParam(':id', $id);
$SuppressionTypeDemande->execute();
header('Location: typesDedemandes.php');
