<?php

require_once 'classes/baseDonne.php';
$bdd = new baseDonne();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le formulaire a été soumis

    $quizName = $_POST['quizName'];
    $quizDescription = $_POST['quizDescription'];
    $questions = $_POST['questions'];
    $propositions = $_POST['propositions'];

    // Créer le quizz en utilisant la fonction
    $bdd->creerQuizz($quizName, $quizDescription, $questions, $propositions);
    
    // Rediriger directement vers une autre page
    header("Location: creer.php");
}

?>
