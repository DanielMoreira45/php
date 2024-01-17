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

    function questions_texte(int $id) {
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

    function questions_radio(int $id) {
        require_once 'classes/input_radio.php';
        $sql = "SELECT * FROM QuestionRadio NATURAL JOIN AppartientRadio WHERE idQuizz = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $liste_questions = array();
        
        foreach ($questions as $q) {
            $choises = array();
            $choises[] = $q["answer"];
            $choises[] = $q["wrongAnswer1"];
            $choises[] = $q["wrongAnswer2"];
            $choises[] = $q["wrongAnswer3"];
            $question = new input_radio($q["nameQuestion"], $choises, $q["answer"], 1, generateRandomString());
            $liste_questions[] = $question;
        }

        return $liste_questions;
    }

}
?>