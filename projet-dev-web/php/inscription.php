<?php
session_start();

// ==========
// 1) CONFIGURATION DE LA BASE DE DONNÉES
// ==========
$host = 'localhost';
$dbname = 'bluehaven'; // Mets ici le nom de ta base de données
$dbuser = 'root';      // Ton identifiant
$dbpass = '';          // Ton mot de passe (vide sur Wamp par défaut)

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    // Activer le mode d’erreur pour voir les erreurs SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// ==========
// 2) TRAITEMENT DU FORMULAIRE
// ==========
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    // Nettoyer et récupérer les données
    $username = htmlspecialchars(trim($_POST['username']));
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Générer un token unique pour la validation par email
    $token = bin2hex(random_bytes(16));

    // Préparer l’insertion dans la table `users`
    $stmt = $pdo->prepare("
        INSERT INTO users (username, email, password, token) 
        VALUES (:username, :email, :password, :token)
    ");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email',    $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':token',    $token);

    // Exécuter et vérifier si l’insertion a réussi
    if ($stmt->execute()) {
        // ========== OPTIONNEL : ENVOI DE MAIL DE VALIDATION ==========
        // Construit l’URL vers ton script de validation (valider.php)
        // Adapte le chemin à ton dossier / projet
        $validationUrl = "http://localhost/projet-dev-web/php/valider.php?token=" . $token;
        
        // Préparer le contenu de l’email
        $subject = "Validation de votre inscription sur BlueHaven";
        $message = "Bonjour $username,\n\n";
        $message .= "Merci de vous être inscrit sur BlueHaven.\n";
        $message .= "Veuillez cliquer sur le lien suivant pour valider votre inscription :\n";
        $message .= "$validationUrl\n\n";
        $message .= "Si vous n'êtes pas à l'origine de cette inscription, ignorez ce message.\n\n";
        $message .= "Cordialement,\nL'équipe BlueHaven";

        // Éventuellement, change l’adresse d’expéditeur
        $headers = "From: no-reply@bluehaven.com";

        // Envoyer l’email
        // (Sur un serveur local, cette fonction mail() nécessite parfois une config supplémentaire pour fonctionner)
        mail($email, $subject, $message, $headers);

        // Message de succès
        echo "<p>Inscription réussie ! Un email de validation vous a été envoyé.<br><a href='../login.html'>Se connecter</a></p>";
    } else {
        echo "<p>Erreur lors de l'inscription. <a href='../inscription.html'>Réessayez</a></p>";
    }
} else {
    // Au cas où le formulaire n’est pas correctement rempli
    echo "<p>Veuillez remplir tous les champs. <a href='../inscription.html'>Retour</a></p>";
}
