<?php

interface IRender {
    public function render(): string;
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