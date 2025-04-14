<?php
require 'sendMail.php';  

session_start();
$pdo = new PDO("mysql:host=localhost;dbname=bluehaven;charset=utf8", "root", "");
$message = "";

// Vérifie si le formulaire est soumis
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Génère un code de vérification unique
    $verification_code = rand(100000, 999999);
    $is_validated = 0;

    // Vérifie si l'email existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    if ($stmt->fetchColumn() > 0) {
        $message = "❌ Email déjà utilisé.";
    } else {
        // Insère l'utilisateur
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, verification_code, is_validated)
                               VALUES (:username, :email, :password, :verification_code, :is_validated)");
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
            ':verification_code' => $verification_code,
            ':is_validated' => $is_validated
        ]);

        if (envoyerMailVerification($email, $verification_code)) {
            // Redirection vers la page de vérification
            header("Location: validate.php?email=" . urlencode($email));
            exit();
        } else {
            $message = "❌ Échec de l'envoi du mail de vérification.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Inscription</h1>

        <?php if (!empty($message)) echo "<p class='mb-4 text-center text-blue-600 font-semibold'>$message</p>"; ?>

        <?php if (!isset($_SESSION['code'])): ?>
            <!-- Formulaire d'inscription -->
            <form method="POST" class="space-y-4">
                <input type="text" name="username" required placeholder="Nom d'utilisateur" class="w-full px-4 py-2 border rounded" />
                <input type="email" name="email" required placeholder="Email" class="w-full px-4 py-2 border rounded" />
                <input type="password" name="password" required placeholder="Mot de passe" class="w-full px-4 py-2 border rounded" />
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">S'inscrire</button>
            </form>
        <?php elseif (isset($_SESSION['code'])): ?>
            <!-- Formulaire de vérification -->
            <p class="text-center font-bold text-lg mb-2">Votre code de vérification est :</p>
            <div class="text-center text-2xl font-mono bg-gray-100 border rounded p-2 mb-4"><?= $_SESSION['code'] ?></div>

            <form method="POST" class="space-y-4">
                <input type="text" name="code" required placeholder="Entrez le code ici" class="w-full px-4 py-2 border rounded text-center" />
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Vérifier</button>
            </form>
        <?php endif; ?>

        <p class="mt-4 text-center text-sm text-gray-600">Déjà un compte ? <a href="login.php" class="text-blue-500">Se connecter</a></p>
    </div>
</body>
</html>
