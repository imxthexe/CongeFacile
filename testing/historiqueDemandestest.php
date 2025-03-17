<?php

include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$data = [];
$errors = [];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    $requete = $connexion->prepare(
        'SELECT id, email, password
        FROM user
        WHERE email = :email
    ');
    

    $requete->bindParam('email', $data['email']);
    $requete->execute();
    $utilisateur = $requete->fetch(\PDO::FETCH_ASSOC);


    if ($utilisateur === false) {
        $erreurs['email'] = 'Compte non valide.';
    } else {
        if (password_verify($data['password'], $utilisateur['password'])) {

            $_SESSION['utilisateur'] = [
                'id' => $utilisateur['id'],
                'email' => $utilisateur['email']
            ];



            // On redirige l'utilisateur sur la page d'accueil.
            header('Location: index.php');
        } else {    
            // KO mot de passe incorrect
            $erreurs['email'] = 'Compte non valide.';
            echo "compte non valide";
        }
    }


    $RegexMail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    $data['email'] = trim($data['email']);
    $data['password'] = trim($data['password']);

    $data['email'] = htmlspecialchars($data['email']);
    $data['password'] = htmlspecialchars($data['password']);

    if (empty($data['email'])) {
        $errors['email'] = 'Veuillez renseigner votre email';
    } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Votre email est incorrect';
    } elseif (!preg_match($RegexMail, $data['email'])) {
        $errors['email'] = "Votre email est incorrect";
    }

    if (empty($data['password'])) {
        $errors['password'] = 'Veuillez saisir votre mot de passe.';
    }

}





























// Paramètres de connexion à la base de données
$host     = 'localhost';
$dbname   = 'conge-facile';
$username = 'root';       // À modifier selon ta configuration
$password = '';           // À modifier selon ta configuration

try {
    // Connexion à la base de données avec PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active le mode exception pour faciliter le débogage
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Récupère les résultats sous forme de tableau associatif
    ];
    $pdo = new PDO($dsn, $username, $password, $options);

    // Requête SQL qui récupère les informations souhaitées
    $sql = "SELECT 
                r.created_at, 
                r.start_at, 
                r.end_at, 
                DATEDIFF(r.end_at, r.start_at) AS nb_days,
                p.first_name, 
                p.last_name, 
                rt.name AS request_type_name,
                r.answer_comment
            FROM request r
            JOIN person p ON r.collaborator_id = p.id
            JOIN request_type rt ON r.request_type_id = rt.id";
            
    // Préparation et exécution de la requête
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Récupération de tous les résultats
    $results = $stmt->fetchAll();

    // Parcours des résultats et affectation à des variables PHP
    foreach ($results as $row) {
        $createdAt       = $row['created_at'];
        $startAt         = $row['start_at'];
        $endAt           = $row['end_at'];
        $nbDays          = $row['nb_days'];
        $firstName       = $row['first_name'];
        $lastName        = $row['last_name'];
        $requestTypeName = $row['request_type_name'];
        $answerComment   = $row['answer_comment'];

        // Affichage ou utilisation des variables
        echo "Créé le : $createdAt<br>";
        echo "Début : $startAt<br>";
        echo "Fin : $endAt<br>";
        echo "Nombre de jours : $nbDays<br>";
        echo "Collaborateur : $firstName $lastName<br>";
        echo "Type de demande : $requestTypeName<br>";
        echo "Commentaire : $answerComment<br><br>";
    }

} catch (PDOException $e) {
    // Gestion des erreurs de connexion ou d'exécution
    echo "Erreur de connexion ou d'exécution : " . $e->getMessage();
}





























$date   = [];
$errors = [];

// Définition de la requête SQL
$sql = "SELECT 
            r.created_at, 
            r.start_at, 
            r.end_at, 
            DATEDIFF(r.end_at, r.start_at) AS nb_days,
            p.first_name, 
            p.last_name, 
            rt.name AS request_type_name,
            r.answer_comment
        FROM request r
        JOIN person p ON r.collaborator_id = p.id
        JOIN request_type rt ON r.request_type_id = rt.id";

try {
    // Préparation et exécution de la requête
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Récupération de tous les résultats sous forme de tableau associatif
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Parcours des résultats et stockage dans le tableau $date
    foreach ($results as $row) {
        $date[] = [
            'created_at'       => $row['created_at'],
            'start_at'         => $row['start_at'],
            'end_at'           => $row['end_at'],
            'nb_days'          => $row['nb_days'],
            'first_name'       => $row['first_name'],
            'last_name'        => $row['last_name'],
            'request_type_name'=> $row['request_type_name'],
            'answer_comment'   => $row['answer_comment']
        ];
    }
} catch (PDOException $e) {
    // En cas d'erreur, on l'ajoute au tableau $errors
    $errors[] = "Erreur d'exécution : " . $e->getMessage();
}

// Ici, le tableau $date contient toutes les informations récupérées
// et le tableau $errors contient les éventuelles erreurs.
?>


?>


























<?php
// Affichage des données stockées dans le tableau $date
if (!empty($date)) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr style='background-color: #f2f2f2;'>
            <th>Créé le</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Nombre de jours</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Type de demande</th>
            <th>Commentaire</th>
          </tr>";
    foreach ($date as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
        echo "<td>" . htmlspecialchars($row['start_at']) . "</td>";
        echo "<td>" . htmlspecialchars($row['end_at']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nb_days']) . "</td>";
        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['request_type_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['answer_comment']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucune donnée trouvée.";
}

?>