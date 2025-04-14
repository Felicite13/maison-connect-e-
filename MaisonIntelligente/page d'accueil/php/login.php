<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=bluehaven;charset=utf8", "root", "");

$message = "";

if (isset($_POST['email'], $_POST['password'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Récupération de l'utilisateur correspondant à l'email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $message = "✅ Connexion réussie ! Redirection...";

        // Redirige vers la page d'accueil ou dashboard
        header("refresh:2;url=inscription.php");
        exit;
    } else {
        $message = "❌ Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Connexion</h1>

        <?php if (!empty($message)) : ?>
            <p class="mb-4 text-center <?= str_contains($message, '✅') ? 'text-green-600' : 'text-red-600' ?>">
                <?= $message ?>
            </p>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <input type="email" name="email" required placeholder="Email" class="w-full px-4 py-2 border rounded" />
            <input type="password" name="password" required placeholder="Mot de passe" class="w-full px-4 py-2 border rounded" />
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Se connecter</button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Pas encore inscrit ? <a href="inscription.php" class="text-blue-500">Créer un compte</a>
        </p>
    </div>
</body>
</html>
