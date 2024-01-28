<?php
require_once 'classes/Irender.php';
class questions implements Irender{
    protected $idQuizz;
    protected $nameQuizz;
    protected $description;
    protected $questions;

    public function __construct(int $idQuizz, string $nameQuizz, string $description, array $questions) {
        $this->idQuizz = $idQuizz;
        $this->nameQuizz = $nameQuizz;
        $this->description = $description;
        $this->questions = $questions;
    }

    public function getName(){
        return $this->nameQuizz;
    }

    public function render(): string {
        $html = "<div class='quizz'>";
        $html .= "<h2>$this->nameQuizz</h2>";
        $html .= "<p>$this->description</p>";
        $html .= "<input type='hidden' name='idQuizz' value='$this->idQuizz'>";
        for ($i = 0; $i < count($this->questions); $i++) {
            $html .= $this->questions[$i]->render();
        }
        $html .= "</div>";
        return $html;
    }
    
    public function getQuestions(){
        return $this->questions;
    }

    public function getReponses(){
        $reponses = array();
        for ($i = 0; $i < count($this->questions); $i++) {
            $reponses[] = $this->questions[$i]->getReponse();
        }
        return $reponses;
    }

    public function getReponsesCorrectes(){
        $reponses = array();
        for ($i = 0; $i < count($this->questions); $i++) {
            $reponses[] = $this->questions[$i]->getReponseCorrecte();
        }
        return $reponses;
    }



}
?>