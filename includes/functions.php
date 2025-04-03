<link rel="stylesheet" href="../style.css">

<?php



function afficheErreur(string $nomDuChamp, array $erreurs): string
{
    if (isset($erreurs[$nomDuChamp])) {
        return '<span class="errors" style="color: red; padding-bottom:30px;">' . $erreurs[$nomDuChamp] . '</span>';
    }

    return '';
}

function afficheValeur(string $nomDuChamp, array $donnesEnvoyees): string
{
    if (isset($donnesEnvoyees[$nomDuChamp])) {
        return $donnesEnvoyees[$nomDuChamp];
    }

    return '';
}
