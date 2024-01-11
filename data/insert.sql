-- Ajoutez des données à la table Quizz
INSERT INTO Quizz (idQuizz, nameQuizz, description) VALUES
(1, 'Quizz Général', 'Test de connaissances générales'),
(2, 'Quizz Mathématiques', 'Test de compétences mathématiques');

-- Ajoutez des données à la table QuestionRadio
INSERT INTO QuestionRadio (idRadio, nameQuestion, answer, wrongAnswer1, wrongAnswer2, wrongAnswer3) VALUES
(1, 'Quelle est la capitale de la France ?', 'Paris', 'Londres', 'Berlin', 'Madrid'),
(2, 'Combien de côtés a un triangle ?', '3', '4', '5', '6');

-- Ajoutez des données à la table QuestionText
INSERT INTO QuestionText (idText, nameQuestion, answer) VALUES
(1, "Quelle est la formule de l'eau ?", 'H2O'),
(2, 'Qui a écrit Roméo et Juliette ?', 'William Shakespeare');

-- Ajoutez des données à la table QuestionCheckbox
INSERT INTO QuestionCheckbox (idCheckbox, nameQuestion, answer1, answer2, answer3, answer4) VALUES
(1, 'Quels sont les couleurs primaires ?', 'Rouge', 'Vert', 'Bleu', 'Jaune'),
(2, 'Quels sont les continents du monde ?', 'Amérique', 'Asie', 'Europe', 'Afrique');

-- Ajoutez des données à la table AppartientRadio
INSERT INTO AppartientRadio (idQuizz, idRadio) VALUES
(1, 1),
(1, 2),
(2, 1);

-- Ajoutez des données à la table AppartientText
INSERT INTO AppartientText (idQuizz, idText) VALUES
(1, 1),
(2, 2);

-- Ajoutez des données à la table AppartientCheckbox
INSERT INTO AppartientCheckbox (idQuizz, idCheckbox) VALUES
(1, 1),
(1, 2),
(2, 2);
