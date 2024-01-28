<?php

require_once 'classes/baseDonne.php';
$bd = new baseDonne();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizName = $_POST['quizName'];
    $quizDescription = $_POST['quizDescription'];
    $questions = $_POST['questions'];

    $bd->creerQuizz($quizName, $quizDescription, $questions);
}

?>
<!DOCTYPE html>
<body>
    <form action="" method="post">
        <label for="quizName">Nom du Quiz:</label>
        <input type="text" name="quizName" required><br>

        <label for="quizDescription">Description du Quiz:</label>
        <input type="text" name="quizDescription" required><br>

        <label for="question1">Question 1:</label>
        <input type="text" name="questions[0]" required><br>

        <label for="question2">Question 2:</label>
        <input type="text" name="questions[1]" required><br>

        <label for="question3">Question 3:</label>
        <input type="text" name="questions[2]" required><br>

        <button type="submit">Créer le Quiz</button>
    </form>
</body>
</html>