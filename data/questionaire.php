<?php

interface IRender {
    public function render(): string;
}

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

    function get_Question_from_db() {
        $sql = "SELECT * FROM QuestionText";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $questions;
    }

    function questions_texte() {
        $sql = "SELECT * FROM QuestionText";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $questions;
    }

    function liste_questions_from_db() {
        $questions = $this->questions_texte();
        $liste_questions = array();
        
        foreach ($questions as $q) {
            $question = new question_text($q["nameQuestion"], $q["answer"], 1, "gpzorg,rpezign,etojsnrtoj");
            $liste_questions[] = $question;
        }

        return $liste_questions;
    }
}

function get_Question(){
    $source = 'data/data.json';
    $content = file_get_contents($source);
    $questions = json_decode($content, True);
    if (empty($questions)){
        new Exception("Le fichier $source ne contient pas de données valides");
    } else {
        return $questions;
    }
}

function liste_questions(){
    $questions = get_Question();
    $liste_questions = array();
    foreach ($questions as $q) {
        if ($q["type"] == "text"){
            $question = new question_text($q["label"], $q["correct"], 1, $q["uuid"]);
        } else {
        $question = new question_radio($q["label"], $q["choices"], $q["correct"],1, $q["uuid"]);
        }
        $liste_questions[] = $question;
        
    }
    return $liste_questions;
}

class question_radio implements IRender {

    protected $label;
    protected $choices;
    protected $answer;
    protected $score;
    protected $nameIdentifier;

    public function __construct(string $label, array $choices, string $answer, int $score, string $name) {
        $this->label = $label;
        $this->choices = $choices;
        $this->answer = $answer;
        $this->score = $score;
        $this->nameIdentifier = $name;
    }

    public function render(): string {
        $html = $this->label . "<br>";
        $i = 0;
        
        foreach ($this->choices as $c) {
            $i += 1;
            $html .= "<input type='radio' name='{$this->nameIdentifier}' value='$i'";
            $html .= "<label for='$i'>$c</label>";
        }
    
        return $html .= "<br>";
    }
        
    public function correct($answer){
        if ($this->answer == $this->choices[$answer]){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function getlabel(){
        return $this->label;
    }
    public function getName(){
        return $this->nameIdentifier;
    }
    public function getCorrectAnswer(){
        return $this->answer;
    }
}

class question_text implements IRender {

    protected $label;
    protected $answer;
    protected $score;
    protected $nameIdentifier;

    public function __construct(string $label, string $answer, int $score, string $name) {
        $this->label = $label;
        $this->answer = $answer;
        $this->score = $score;
        $this->nameIdentifier = $name;
    }

    public function render(): string {
        $html = $this->label . "<br>";
        $html .= "<input type='text' name='{$this->nameIdentifier}'><br>";
        return $html;
    }
    
    public function getAnswer(){
        return $this->answer;
    }

    public function getScore(){
        return $this->score;
    }

    public function getlabel(){
        return $this->label;
    }

    public function correct($answer){
        if ($answer == $this->answer){
            return TRUE;
        } else {
            return FALSE;
        }

    }
    public function getName(){
        return $this->nameIdentifier;
    }

    public function getCorrectAnswer(){
        return $this->answer;
    }

}
?>