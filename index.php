<?php
require_once 'classes/baseDonne.php';
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

    <?php
    foreach ($liste_questions as $q) {
        echo $q->render();
    }

    ?>
    <form action="creer.php" method="get">
        <button>Créer un quizz</button>
    </form>
    </form>
</body>

</html>