<?php
require_once 'classes/Irender.php';
class quizz implements IRender {
    protected $idQuizz;
    protected $name;
    protected $description;

    public function __construct(int $idQuizz, string $name, string $description) {
        $this->idQuizz = $idQuizz;
        $this->name = $name;
        $this->description = $description;
    }

    public function render(): string{
        $html = "<div class='quizz'>";
        $html .= "<h2>$this->name</h2>";
        $html .= "<p>$this->description</p>";
        $html .= "<a href='playquizz.php?id=$this->idQuizz'>Jouer</a>";
        $html .= "</div>";
        return $html;
    }
}
?>