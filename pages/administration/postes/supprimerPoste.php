<?php

include '../../../includes/database.php';
$id = $_GET['id'];

$SuppressionTypeDemande = $bdd->prepare('DELETE FROM department WHERE id=:id');
$SuppressionTypeDemande->bindParam(':id', $id);
$SuppressionTypeDemande->execute();
session_start();
$_SESSION['success_message'] = 'Le département a été supprimé avec succès.';
header('Location: ../directionsServices/directionsServices.php');
exit();
