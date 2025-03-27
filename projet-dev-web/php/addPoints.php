<?php
require_once 'updateUserLevel.php';

/**
 * Ajoute des points à un utilisateur et met à jour son niveau.
 * @param int $userId
 * @param float $pointsToAdd
 * @param PDO $pdo
 * @return array|false ['points' => newTotal, 'level' => newLevel] ou false en cas d'erreur.
 */
function addPoints($userId, $pointsToAdd, $pdo) {
    $stmt = $pdo->prepare("SELECT points FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $currentPoints = floatval($result['points']);
        $newPoints = $currentPoints + $pointsToAdd;
        $updateStmt = $pdo->prepare("UPDATE users SET points = :points WHERE id = :id");
        $updateStmt->bindParam(':points', $newPoints);
        $updateStmt->bindParam(':id', $userId);
        $updateStmt->execute();
        
        $newLevel = updateUserLevel($userId, $newPoints, $pdo);
        return ['points' => $newPoints, 'level' => $newLevel];
    } else {
        return false;
    }
}
?>
