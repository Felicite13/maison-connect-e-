<?php
session_start();

// Configuration de la base de données
$host = 'localhost';
$dbname = 'smart_home';
$dbuser = 'root';
$dbpass = ''; // Adaptez selon votre configuration locale

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier que le formulaire est soumis
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    // Nettoyer et récupérer les données
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Ici, vous pouvez ajouter une vérification pour vous assurer que l'utilisateur est autorisé à s'inscrire (si besoin)

    // Générer un token unique pour la validation par email
    $token = bin2hex(random_bytes(16));

    // Préparer l'insertion dans la base de données en utilisant la table users mise à jour
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, token) VALUES (:username, :email, :password, :token)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':token', $to<?php
    session_start();
    
    // Configuration de la base de données
    $host = 'localhost';
    $dbname = 'bluehaven';
    $dbuser = 'root';
    $dbpass = ''; // Adaptez selon votre configuration
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
    
    // Vérifier que le formulaire est soumis
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        // Nettoyer et récupérer les données
        $username = htmlspecialchars(trim($_POST['username']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    
        // Vérifier que l'utilisateur est membre autorisé (ici, on accepte tout)
        // Vous pouvez ajouter une vérification par rapport à une liste pré-enregistrée si besoin
    
        // Générer un token unique pour la validation
        $token = bin2hex(random_bytes(16));
    
        // Préparer l'insertion dans la base de données
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, token) VALUES (:username, :email, :password, :token)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':token', $token);
    
        if ($stmt->execute()) {
            // Construire l'URL de validation
            // Adaptez "localhost/bluehaven" à votre configuration (si vous utilisez un domaine ou port spécifique)
            $validationUrl = "http://localhost/bluehaven/php/valider.php?token=" . $token;
    
            // Préparer l'email de validation
            $subject = "Validation de votre inscription sur BlueHaven";
            $message = "Bonjour $username,\n\nMerci de vous être inscrit sur BlueHaven.\n";
            $message .= "Veuillez cliquer sur le lien suivant pour valider votre inscription :\n";
            $message .= "$validationUrl\n\n";
            $message .= "Si vous n'êtes pas à l'origine de cette inscription, ignorez ce message.\n\nCordialement,\nL'équipe BlueHaven";
            $headers = "From: no-reply@bluehaven.com";
    
            // Envoyer l'email
            // Assurez-vous que votre serveur local est configuré pour envoyer des mails
            mail($email, $subject, $message, $headers);
    
            echo "<p>Inscription réussie ! Un email de validation vous a été envoyé.<br><a href='../login.html'>Se connecter</a></p>";
        } else {
            echo "<p>Erreur lors de l'inscription. <a href='../inscription.html'>Réessayez</a></p>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs. <a href='../inscription.html'>Retour</a></p>";
    }
    ?>
    ken);

    if ($stmt->execute()) {
        // (Optionnel) Envoi d'un email de validation
        /*
        $subject = "Validation de votre inscription sur BlueHaven";
        $message = "Bonjour $username,\n\nMerci de vous être inscrit sur BlueHaven.\n";
        $message .= "Veuillez cliquer sur le lien suivant pour valider votre inscription :\n";
        $message .= "http://votre-domaine/bluehaven/php/valider.php?token=$token\n\n";
        $message .= "Cordialement,\nL'équipe BlueHaven";
        $headers = "From: no-reply@bluehaven.com";
        mail($email, $subject, $message, $headers);
        */
        echo "<p>Inscription réussie ! Un email de validation vous a été envoyé.<br><a href='../login.html'>Se connecter</a></p>";
    } else {
        echo "<p>Erreur lors de l'inscription. <a href='../inscription.html
