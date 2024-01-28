-- Supprimez les tables si elles existent déjà

DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS TypeQuestion;
DROP TABLE IF EXISTS Reponse;
DROP TABLE IF EXISTS Quizz;

-- Créez la table Quizz
CREATE TABLE Quizz (
    idQuizz INT PRIMARY KEY,
    nameQuizz VARCHAR(255),
    `description` VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS TypeQuestion (
    idType INTEGER PRIMARY KEY,
    libelleType VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS Question (
    idQuizz INTEGER,
    idType INTEGER,
    idQuestion INTEGER,
    libelleQuestion TEXT,
    nameIdentifier TEXT,
    PRIMARY KEY(idQuizz, idQuestion),
    FOREIGN KEY(idQuizz) REFERENCES Quizz(idQuizz),
    FOREIGN KEY(idType) REFERENCES TypeQuestion(idType)
);

CREATE TABLE IF NOT EXISTS Reponse (
    idQuestion INTEGER,
    idReponse INTEGER,
    idQuizz INTEGER,
    libelleReponse TEXT,
    estCorrect BOOLEAN,
    PRIMARY KEY(idQuizz, idQuestion, idReponse),
    FOREIGN KEY(idQuestion) REFERENCES Question(idQuestion)
    FOREIGN KEY(idQuizz) REFERENCES Quizz(idQuizz)
);

-- Ajoutez des données à la table Quizz
INSERT INTO Quizz (idQuizz, nameQuizz, `description`) VALUES
(1, 'Quizz Capitales', 'Quiz sur les capitales du monde'),
(2, 'Quizz Mathématiques', 'Test de compétences mathématiques');

INSERT INTO TypeQuestion (idType, libelleType) VALUES 
(1, 'Radio'),
(2, 'Texte');

-- Ajoutez des données à la table QuestionRadio
INSERT INTO Question (idQuizz, idType, idQuestion, libelleQuestion, nameIdentifier) VALUES
(1, 1, 1, 'Quelle est la capitale de la France ?','xiIwcVIf7Y'),
(1, 1, 2, 'Quelle est la capitale de l''Allemagne ?','R8ayhN1E8B'),
(1, 1, 3, 'Quelle est la capitale de l''Italie ?','fqNrxLDo6v'),
(1, 1, 4, 'Quelle est la capitale de l''Espagne ?','X8Z3Z2Z2Z2'),
(1, 1, 5, 'Quelle est la capitale du Canada ?','WWZdPON51Z'),
(1, 1, 6, 'Quelle est la capitale du Japon ?', 'Z2Z2Z2Z2Z2'),
(1, 1, 7, 'Quelle est la capitale de l''Australie ?', 'gtOykGCJ4b'),
(1, 1, 8, 'Quelle est la capitale du Brésil ?', 'BYZQ2Q3wuQ'),
(1, 1, 9, 'Quelle est la capitale de la Chine ?', 'x7MVYEdlPB'),
(1, 1, 10, 'Quelle est la capitale de l''Inde ?', 'u9zlX5Wp8u'),
(2, 2, 1, 'Combien font 5 + 3 ?','ISyaNA7PNw'),
(2, 2, 2, 'Combien font 7 - 2 ?', 'GfiSo4InND'),
(2, 2, 3, 'Combien font 2 * 4 ?', 'G2q8TiN3y9'),
(2, 2, 4, 'Combien font 10 / 2 ?', 'NIWRLLozo2');

INSERT INTO Reponse (idQuestion, idReponse, idQuizz, libelleReponse, estCorrect) VALUES
(1, 1, 1, 'Paris', 1),
(1, 2, 1, 'Lyon', 0),
(1, 3, 1, 'Marseille', 0),
(1, 4, 1, 'Toulouse', 0),
(2, 1, 1, 'Berlin', 1),
(2, 2, 1, 'Hambourg', 0),
(2, 3, 1, 'Munich', 0),
(2, 4, 1, 'Francfort', 0),
(3, 1, 1, 'Rome', 1),
(3, 2, 1, 'Milan', 0),
(3, 3, 1, 'Naples', 0),
(3, 4, 1, 'Turin', 0),
(4, 1, 1, 'Madrid', 1),
(4, 2, 1, 'Barcelone', 0),
(4, 3, 1, 'Séville', 0),
(4, 4, 1, 'Valence', 0),
(5, 1, 1, 'Ottawa', 1),
(5, 2, 1, 'Toronto', 0),
(5, 3, 1, 'Vancouver', 0),
(5, 4, 1, 'Montreal', 0),
(6, 1, 1, 'Tokyo', 1),
(6, 2, 1, 'Osaka', 0),
(6, 3, 1, 'Kyoto', 0),
(6, 4, 1, 'Yokohama', 0),
(7, 1, 1, 'Canberra', 1),
(7, 2, 1, 'Sydney', 0),
(7, 3, 1, 'Melbourne', 0),
(7, 4, 1, 'Brisbane', 0),
(8, 1, 1, 'Brasilia', 1),
(8, 2, 1, 'Rio de Janeiro', 0),
(8, 3, 1, 'Sao Paulo', 0),
(8, 4, 1, 'Belo Horizonte', 0),
(9, 1, 1, 'Pékin', 1),
(9, 2, 1, 'Shanghai', 0),
(9, 3, 1, 'Canton', 0),
(9, 4, 1, 'Shenzhen', 0),
(10, 1, 1, 'New Delhi', 1),
(10, 2, 1, 'Mumbai', 0),
(10, 3, 1, 'Bangalore', 0),
(10, 4, 1, 'Kolkata', 0),
(1, 1, 2, '8', 1),
(2, 1, 2, '5', 1),
(3, 1, 2, '8', 1),
(4, 1, 2, '5', 1);

