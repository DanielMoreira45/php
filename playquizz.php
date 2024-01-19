<?php
require_once 'classes/baseDonne.php';
session_start();    
$id = $_GET["id"];
$bd = new baseDonne();
$quizz = $bd->getQuizz($id);
$_SESSION['quizz'] = $quizz;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <form action="reponse.php" method="get">

        <h1>
            <?php echo $quizz["nameQuizz"] ?>
        </h1>
        <p>
            <?php echo $quizz["description"] ?>
        </p>
        <?php
        foreach ($quizz["questions"] as $q) {
            echo $q->render();
        }

        ?>
        <input type="submit" value="Envoyer">
    </form>
</body>

</html>