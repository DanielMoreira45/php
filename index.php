<?php
require_once 'classes/baseDonne.php';
require_once 'data/questionaire.php';
$bd = new baseDonne();
$liste_questions = $bd->getAllQuizz();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>
</head>
<body>
    <form action="reponse.php" method="get">
        <?php
        foreach ($liste_questions as $q) {
            echo $q->render();
        }
        $queryQuizz = $bd->getAllQuizz();
        echo "<div>";
        echo '<form method="get" action="formulaireQuizz.php">';
        echo '<label for="quiz">Nom du nouveau quiz :</label>';
        echo '<input type="hidden" name="id_quizz" value="' . $id . '">';
        echo '<input type="text" name="quiz" required>';
        echo '<button type="submit">Créer le quiz</button>';
        echo "</div>";
        echo "<h1>MES QUIZS</h1>";
        echo '<ul>';
        
        ?>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>