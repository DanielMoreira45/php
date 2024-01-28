<?php
require_once 'classes/baseDonne.php';
session_start();    
$id = $_GET["id"];
$bd = new baseDonne();
$quizz = $bd->getQuizz($id);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <form action="reponse.php" method="get">
        <?php
        echo $quizz->render();
        ?>
        <input type="submit" value="Envoyer">
    </form>
</body>

</html>