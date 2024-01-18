<?php
require_once 'classes/baseDonne.php';
$bd = new baseDonne();
$liste_questions = $bd->getAllQuizz();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="data/css/index.css">
    <title>Formulaire</title>
</head>

<body>
    <div>
    <?php
    foreach ($liste_questions as $q) {
        echo $q->render();
    }

    ?>
    </div>
    <form action="creer.php" method="post">
    <button type="submit">Créer un quizz</button>
</form>


</body>

</html>