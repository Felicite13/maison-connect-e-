<?php
session_start();

// Configuration de la base de données
$host = 'localhost';
$dbname = 'bluehaven';
$dbuser = 'root';
$dbpass = ''; // Adaptez si besoin

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si le token est présent dans l'URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Chercher un utilisateur correspondant au token
    $stmt = $pdo->prepare("SELECT id, status FROM users WHERE token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérifier que l'utilisateur est encore en attente
        if ($user['status'] === 'en_attente') {
            // Mettre à jour le statut de l'utilisateur à actif et effacer le token
            $updateStmt = $pdo->prepare("UPDATE users SET status = 'actif', token = NULL WHERE id = :id");
            $updateStmt->bindParam(':id', $user['id']);
            if ($updateStmt->execute()) {
                echo "<p>Votre inscription a été validée ! Vous pouvez désormais <a href='../login.html'>vous connecter</a>.</p>";
            } else {
                echo "<p>Une erreur est survenue lors de la validation. Veuillez réessayer.</p>";
            }
        } else {
            echo "<p>Votre inscription est déjà validée. <a href='../login.html'>Se connecter</a></p>";
        }
    } else {
        echo "<p>Token invalide. Veuillez vérifier le lien de validation.</p>";
    }
} else {
    echo "<p>Aucun token fourni.</p>";
}
?>
