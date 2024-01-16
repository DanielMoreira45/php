-- Supprimez les tables si elles existent déjà
DROP TABLE IF EXISTS AppartientCheckbox;
DROP TABLE IF EXISTS AppartientText;
DROP TABLE IF EXISTS AppartientRadio;
DROP TABLE IF EXISTS QuestionCheckbox;
DROP TABLE IF EXISTS QuestionText;
DROP TABLE IF EXISTS QuestionRadio;
DROP TABLE IF EXISTS Quizz;

-- Créez la table Quizz
CREATE TABLE Quizz (
    idQuizz INT PRIMARY KEY,
    nameQuizz VARCHAR(255),
    `description` VARCHAR(255)
);

-- Créez la table QuestionRadio
CREATE TABLE QuestionRadio (
    idRadio INT PRIMARY KEY,
    nameQuestion VARCHAR(255),
    answer VARCHAR(255),
    wrongAnswer1 VARCHAR(255),
    wrongAnswer2 VARCHAR(255),
    wrongAnswer3 VARCHAR(255)
);

-- Créez la table QuestionText
CREATE TABLE QuestionText (
    idText INT PRIMARY KEY,
    nameQuestion VARCHAR(255),
    answer VARCHAR(255)
);

-- Créez la table QuestionCheckbox
CREATE TABLE QuestionCheckbox (
    idCheckbox INT PRIMARY KEY,
    nameQuestion VARCHAR(255),
    answer1 VARCHAR(255),
    answer2 VARCHAR(255),
    answer3 VARCHAR(255),
    answer4 VARCHAR(255)
);

-- Créez la table AppartientRadio
CREATE TABLE AppartientRadio (
    idQuizz INT,
    idRadio INT,
    PRIMARY KEY(idQuizz, idRadio),
    FOREIGN KEY(idQuizz) REFERENCES Quizz(idQuizz),
    FOREIGN KEY(idRadio) REFERENCES QuestionRadio(idRadio)
);

-- Créez la table AppartientText
CREATE TABLE AppartientText (
    idQuizz INT,
    idText INT,
    PRIMARY KEY(idQuizz, idText),
    FOREIGN KEY(idQuizz) REFERENCES Quizz(idQuizz),
    FOREIGN KEY(idText) REFERENCES QuestionText(idText)
);

-- Créez la table AppartientCheckbox
CREATE TABLE AppartientCheckbox (
    idQuizz INT,
    idCheckbox INT,
    PRIMARY KEY(idQuizz, idCheckbox),
    FOREIGN KEY(idQuizz) REFERENCES Quizz(idQuizz),
    FOREIGN KEY(idCheckbox) REFERENCES QuestionCheckbox(idCheckbox)
);

-- Ajoutez des données à la table Quizz
INSERT INTO Quizz (idQuizz, nameQuizz, `description`) VALUES
(1, 'Quizz Général', 'Test de connaissances générales'),
(2, 'Quizz Mathématiques', 'Test de compétences mathématiques');

-- Ajoutez des données à la table QuestionRadio
INSERT INTO QuestionRadio (idRadio, nameQuestion, answer, wrongAnswer1, wrongAnswer2, wrongAnswer3) VALUES
(1, 'Quelle est la capitale de la France ?', 'Paris', 'Londres', 'Berlin', 'Madrid'),
(2, 'Combien de côtés a un triangle ?', '3', '4', '5', '6');

-- Ajoutez des données à la table QuestionText
INSERT INTO QuestionText (idText, nameQuestion, answer) VALUES
(1, 'Quelle est la formule de l''eau ?', 'H2O'),
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
