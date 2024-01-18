<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un quizz</title>
</head>
<body>
    <form action="save.php" method="post">
        <label for="quizName">Nom du Quiz:</label>
        <input type="text" name="quizName" required><br>

        <label for="quizDescription">Description du Quiz:</label>
        <input type="text" name="quizDescription" required><br>

        <label for="question1">Question 1:</label>
        <input type="text" name="questions[0]" required><br>

        <label for="proposition1">proposition 1 et bonne réponse:</label>
        <input type="text" name="propositions[0][0]" required><br>
        <label for="proposition2">Proposition 2:</label>
        <input type="text" name="propositions[0][0]" required><br>
        <label for="proposition3">Proposition 3:</label>
        <input type="text" name="propositions[0][0]" required><br>
        <label for="proposition4">Proposition 4:</label>
        <input type="text" name="propositions[0][0]" required><br>

        <label for="question2">Question 2:</label>
        <input type="text" name="questions[1]" required><br>

        <label for="proposition1">proposition 1 et bonne réponse:</label>
        <input type="text" name="propositions[1][0]" required><br>
        <label for="proposition2">Proposition 2:</label>
        <input type="text" name="propositions[1][0]" required><br>
        <label for="proposition3">Proposition 3:</label>
        <input type="text" name="propositions[1][0]" required><br>
        <label for="proposition4">Proposition 4:</label>
        <input type="text" name="propositions[1][0]" required><br>

        <label for="question3">Question 3:</label>
        <input type="text" name="questions[2]" required><br>

        <label for="proposition1">proposition 1 et bonne réponse:</label>
        <input type="text" name="propositions[2][0]" required><br>
        <label for="proposition2">Proposition 2:</label>
        <input type="text" name="propositions[2][0]" required><br>
        <label for="proposition3">Proposition 3:</label>
        <input type="text" name="propositions[2][0]" required><br>
        <label for="proposition4">Proposition 4:</label>
        <input type="text" name="propositions[2][0]" required><br>

        <button type="submit">Créer le Quiz</button>
    </form>
    <button href="">Retour</button>
</body>
</html>
