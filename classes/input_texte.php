<?php
require_once 'classes/Irender.php';
class input_texte implements IRender {

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