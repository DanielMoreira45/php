<?php
require_once 'classes/input_texte.php';
require_once 'classes/input_radio.php';

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
            $question = new input_texte($q["label"], $q["correct"], 1, $q["uuid"]);
        } else {
        $question = new input_radio($q["label"], $q["choices"], $q["correct"],1, $q["uuid"]);
        }
        $liste_questions[] = $question;
        
    }
    return $liste_questions;
}
?>