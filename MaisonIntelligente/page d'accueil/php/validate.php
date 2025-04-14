<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=bluehaven;charset=utf8", "root", "");

// Vérifie si l'email est passé dans l'URL
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Récupère l'utilisateur associé à cet email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        die("Utilisateur non trouvé.");
    }
}

// Traitement du formulaire de validation du code
if (isset($_POST['verification_code'])) {
    $code_saisi = htmlspecialchars(trim($_POST['verification_code']));

    if ($code_saisi == $user['verification_code']) {
        // Code valide, mettre à jour l'utilisateur comme validé
        $stmt = $pdo->prepare("UPDATE users SET is_validated = 1 WHERE email = :email");
        $stmt->execute([':email' => $email]);

        $message = "Compte validé avec succès ! Vous pouvez maintenant vous connecter.";
    } else {
        $message = "❌ Code de vérification incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérification de compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Vérification de compte</h1>

        <?php if (isset($message)) echo "<p class='mb-4 text-center text-red-600'>$message</p>"; ?>

        <form method="POST" class="space-y-4">
            <input type="text" name="verification_code" required placeholder="Entrez le code de vérification" class="w-full px-4 py-2 border rounded" />
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Valider</button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">Retour à <a href="login.php" class="text-blue-500">la connexion</a></p>
    </div>
</body>
</html>
