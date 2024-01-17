<?php
require_once 'classes/baseDonne.php';
session_start();
$bd = new baseDonne();
$liste_questions = $bd->questions_texte(1);
$liste_questions = array_merge($liste_questions, $bd->questions_radio(1));
$_SESSION['liste_questions'] = $liste_questions;


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