<?php
require_once 'data/questionaire.php';
$liste_questions = liste_questions();
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
        
        ?>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>