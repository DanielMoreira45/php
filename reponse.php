<?php
require_once 'classes/baseDonne.php';
$bd = new baseDonne();
session_start();
$quizz = $_SESSION['quizz'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reponse</title>
</head>
<body>
    <style>
        .bon{
            color:green;
        }
        .mauvais{
            color:red;
        }
        #score{
            position: fixed;
            right: 20%;
            top: 50%;
            transform: translateY(-50%);
            font-size: xx-large;
        }
        #score span{
            display: block;
            text-align: center;
            font-size: 4rem;
        }
    </style>
    <h1>Résultat <?php echo $quizz["nameQuizz"] ?></h1>
    <?php
    $score = 0;
    $maxi = 0;
    foreach ($quizz["questions"] as $q) {
        $name = $q->getName();
        $label = $q->getlabel();
        $correct = false;
        echo "<p><strong>Question</strong>: $label</p>";
        if (isset($_GET[$name])) {
            $selectedAnswer = $_GET[$name];

            $correct = $q->correct($selectedAnswer);
            if ($correct) {
                echo "<p class=\"bon\">Bonne réponse</p>";
                $score += $q->getScore();
            }
        }
        
        if(!$correct){
            echo "<p class=\"mauvais\">Votre réponse : ";
            if(isset($_GET[$name])){
                echo $q->getLibelleReponse($selectedAnswer);
            }else{
                echo "Aucune";
            }
            echo "</p>";
            echo "<p>Réponse correcte: " . $q->getCorrectAnswer() . "</p>";
        }
        $maxi += $q->getScore();
    }
    echo "<p id=\"score\">Score : <span>$score/$maxi</span></p>";

    ?>
</body>
</html>
