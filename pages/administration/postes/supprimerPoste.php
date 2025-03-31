<?php

include '../../../includes/database.php';
$id = $_GET['id'];

$SuppressionTypeDemande = $bdd->prepare('DELETE FROM department WHERE id=:id');
$SuppressionTypeDemande->bindParam(':id', $id);
$SuppressionTypeDemande->execute();
header('Location: postes.php');
