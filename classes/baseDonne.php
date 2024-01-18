<?php
require_once 'data/questionaire.php';

class baseDonne {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('sqlite:Base.db');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connexion réussie à la base de données.";
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    function getQuizz(int $id) {
        $sql = "SELECT * FROM Quizz WHERE idQuizz = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $quizz = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $quizzReturn = array();

        $quizzReturn["idQuizz"] = $quizz[0]["idQuizz"];
        $quizzReturn["nameQuizz"] = $quizz[0]["nameQuizz"];
        $quizzReturn["description"] = $quizz[0]["description"];
        $quizzReturn["questions"] = $this->getQuestions($id);

        return $quizzReturn;
    }

    function getQuestions($id){
        require_once 'classes/input_texte.php';
        $sql = "SELECT * FROM Question NATURAL JOIN Quizz WHERE idQuizz = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $liste_questions = array();
        
        foreach ($questions as $q) 
        {
            $reponse = $this->getReponse($id, $q["idQuestion"]);
            if ($q["idType"] == "1"){
                $question = new input_radio($q["libelleQuestion"], $this->getPropositions($id,$q["idQuestion"]), $reponse, 1, generateRandomString());
            } else {
                $question = new input_texte($q["libelleQuestion"], $reponse, 2, generateRandomString());
            }
            $liste_questions[] = $question;
        }

        return $liste_questions;
    }

    function getPropositions($id, $idQuestion){
        $sql = "SELECT * FROM Reponse NATURAL JOIN Question NATURAL JOIN Quizz WHERE idQuizz = $id and idQuestion = $idQuestion";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $propositions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $propositions;
    }

    function getReponse($id, $idQuestion){
        $sql = "SELECT * FROM Reponse NATURAL JOIN Question NATURAL JOIN Quizz WHERE idQuizz = $id and idQuestion = $idQuestion and estCorrect = \"1\"";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $reponse[0]["libelleReponse"];
    }

    function getAllQuizz() {
        require_once 'classes/quizz.php';
    
        $sql = "SELECT * FROM Quizz";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $quizzData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $liste_quizz = array();
        foreach ($quizzData as $q) {
            $quiz = new quizz($q["idQuizz"], $q["nameQuizz"], $q["description"]);
            $liste_quizz[] = $quiz;
        }
        return $liste_quizz;
    }

    public function creerQuizz($quizName, $quizDescription, $questions, $propositions){
        // Insertion du quizz
        $sqlid = "SELECT MAX(idQuizz) FROM Quizz";
        $stmtid = $this->pdo->prepare($sqlid);
        $stmtid->execute();
        $idQuizzR = $stmtid->fetchAll(PDO::FETCH_ASSOC);
        $idQuizzR = $idQuizzR[0]["MAX(idQuizz)"] + 1;
    
        $sql = "INSERT INTO Quizz (idQuizz, nameQuizz, description) VALUES (:idQuizz, :nameQuizz, :description)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idQuizz', $idQuizzR);
        $stmt->bindParam(':nameQuizz', $quizName);
        $stmt->bindParam(':description', $quizDescription);
        $stmt->execute();
    
        // Récupération de l'ID du quizz nouvellement créé
        $idQuizz = $this->pdo->lastInsertId();
    
        // Insertion des questions et propositions
        for ($i = 0; $i < count($questions); $i++) {
            $question = $questions[$i];
            $maxIdQuestion = $this->pdo->query("SELECT MAX(idQuestion) FROM Question")->fetchColumn();

            // Insertion de la question
            $sql = "INSERT INTO Question (idQuizz, libelleQuestion, idType, idQuestion) VALUES (:idQuizz, :libelleQuestion, 1, :idQuestion)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idQuizz', $idQuizz);
            $stmt->bindParam(':libelleQuestion', $question);
            $stmt->bindParam(':idQuestion', $maxIdQuestion + 1);
            $stmt->execute();
    
            // Récupération de l'ID de la question nouvellement créée
            $idQuestion = $this->pdo->lastInsertId();
    
            // Insertion des propositions
            foreach ($propositions[$i] as $proposition) {
                $maxIdReponse = $this->pdo->query("SELECT MAX(idReponse) FROM Reponse")->fetchColumn();
                $sql = "INSERT INTO Reponse (idQuizz, idQuestion, libelleReponse, estCorrect) VALUES ($idQuizz, $idQuestion, $proposition, :estCorrect, $maxIdReponse +1)";
                $stmt = $this->pdo->prepare($sql);
                // Vous devez ajuster la valeur de :estCorrect en fonction de votre logique
                $stmt->bindValue(':estCorrect', false);
                $stmt->execute();
            }
        }
    }
    
    
}
?>