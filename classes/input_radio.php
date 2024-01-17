<?php
require_once 'classes/Irender.php';
class input_radio implements IRender {

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
?>