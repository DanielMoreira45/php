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
    description VARCHAR(255)
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
