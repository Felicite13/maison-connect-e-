<?php
session_start();

// Configuration de la base de données
$host = 'localhost';
$dbname = 'bluehaven';
$dbuser = 'root';
$dbpass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    die("Erreur de connexion: " . $e->getMessage());
}

if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($user['status'] !== 'actif') {
            echo "<p>Votre compte n'est pas encore activé. Veuillez valider votre email.</p>";
            exit();
        }
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['points'] = $user['points'];
            $_SESSION['level'] = $user['level'];
            
            // Ajouter 0.25 point pour la connexion
            require_once 'updateUserLevel.php';
            require_once 'addPoints.php';
            $pointsResult = addPoints($user['id'], 0.25, $pdo);
            if ($pointsResult) {
                $_SESSION['points'] = $pointsResult['points'];
                $_SESSION['level'] = $pointsResult['level'];
            }
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<p>Mot de passe incorrect. <a href='../login.html'>Réessayer</a></p>";
        }
    } else {
        echo "<p>Utilisateur introuvable. <a href='../login.html'>Réessayer</a></p>";
    }
} else {
    echo "<p>Veuillez remplir le formulaire. <a href='../login.html'>Retour</a></p>";
}
?>
