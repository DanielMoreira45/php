<?php
require_once 'data/questionaire.php';
$liste_questions = liste_questions();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reponse</title>
</head>
<body>
    <?php
    foreach ($liste_questions as $q) {
        $name = $q->getName();
        $label = $q->getlabel();
        if (isset($_GET[$name])) {
            $selectedAnswer = $_GET[$name];

            echo "<p>Question: $label</p>";
            if ($q->correct($selectedAnswer)) {
                echo "<p>Bonne réponse</p>";
            } else {
                echo "<p>Mauvaise réponse</p>";
                echo "<p>Réponse correcte: " . $q->getCorrectAnswer() . "</p>";
            }
        } else {
            echo "<p>Paramètre manquant pour la question : $label</p>";
        }
    }
    ?>
</body>
</html>
