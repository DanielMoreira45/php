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

}
?>