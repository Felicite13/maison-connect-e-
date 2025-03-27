<?php
/**
 * Met à jour le niveau de l'utilisateur en fonction de ses points.
 * @param int $userId
 * @param float $currentPoints
 * @param PDO $pdo
 * @return string Nouveau niveau
 */
function updateUserLevel($userId, $currentPoints, $pdo) {
    if ($currentPoints >= 7) {
        $newLevel = 'expert';
    } elseif ($currentPoints >= 5) {
        $newLevel = 'avancé';
    } elseif ($currentPoints >= 3) {
        $newLevel = 'intermédiaire';
    } else {
        $newLevel = 'débutant';
    }
    $stmt = $pdo->prepare("UPDATE users SET level = :level WHERE id = :id");
    $stmt->bindParam(':level', $newLevel);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    return $newLevel;
}
?>
