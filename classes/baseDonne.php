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
        require_once 'classes/question.php';
        $sql = "SELECT * FROM Quizz WHERE idQuizz = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $quizz = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $quizzReturn = array();
        $quizz = new questions($quizz[0]["idQuizz"], $quizz[0]["nameQuizz"], $quizz[0]["description"], $this->getQuestions($id));
        return $quizz;
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

    function getAllQuizz(){
        require_once 'classes/quizz.php';
        $sql = "SELECT * FROM Quizz";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $quizz = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $liste_quizz = array();
        foreach ($quizz as $q) {
            $quizz = new quizz($q["idQuizz"], $q["nameQuizz"], $q["description"]);
            $liste_quizz[] = $quizz;
        }
        return $liste_quizz;
    }

    function creerQuizz($nameQuizz, $description, $questions){
        $stmt = $this->pdo->prepare("INSERT INTO Quizz (nameQuizz, `description`) VALUES (:name, :description)");
        $stmt->bindParam(':name', $quizName, PDO::PARAM_STR);
        $stmt->bindParam(':description', $quizDescription, PDO::PARAM_STR);
        $stmt->execute();

        $idQuizz = $this->pdo->lastInsertId();

        foreach ($questions as $question) {
            $stmt = $this->pdo->prepare("INSERT INTO Question (idQuizz, idType, libelleQuestion) VALUES (:idQuizz, :idType, :libelleQuestion)");
            $stmt->bindParam(':idQuizz', $idQuizz, PDO::PARAM_INT);
            $stmt->bindParam(':idType', 2, PDO::PARAM_INT);
            $stmt->bindParam(':libelleQuestion', $question, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
}
?>