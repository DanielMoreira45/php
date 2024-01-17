<?php
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
        $sql = "SELECT * FROM QuestionText WHERE idQuestion = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $liste_questions = array();
        
        foreach ($questions as $q) {
            $question = new input_texte($q["nameQuestion"], $q["answer"], 1, "gpzorg,rpezign,etojsnrtoj");
            $liste_questions[] = $question;
        }

        return $liste_questions;
    }

}
?>