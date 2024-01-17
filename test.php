<?php
require_once 'classes/baseDonne.php';
 
$bd = new baseDonne();
$liste_questions = $bd->liste_questions_from_db();


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