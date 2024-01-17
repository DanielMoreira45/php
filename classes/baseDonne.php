<?php
require_once 'data/questionaire.php';

class baseDonne {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('sqlite:Base.db');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie à la base de données.";
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    function questionsQuizz(int $id) {
        require_once 'classes/input_texte.php';
        $sql = "SELECT * FROM QuestionText NATURAL JOIN AppartientText WHERE idQuizz = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $liste_questions = array();
        
        foreach ($questions as $q) {
            $question = new input_texte($q["nameQuestion"], $q["answer"], 1, generateRandomString());
            $liste_questions[] = $question;
        }

        return $liste_questions;
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
}
?>