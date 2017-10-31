<?php
include_once("../Event.php");


if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    if(!empty($_GET["EventID"])) {
        $rounds = Event::GetEventRounds($_GET["EventID"]);
        echo json_encode($rounds); 
    }
    else if(!empty($_GET["UserID"]) && !empty($_GET["RoundID"])) {
        $roundScore = Event::GetRoundScore($_GET["UserID"], $_GET["RoundID"]);
        echo json_encode($roundScore);
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    	
    $UserID = $_POST["UserID"];
    $RoundID = $_POST["RoundID"];
    $Score = $_POST["Score"];
        
    if(Event::RecordScore($UserID, $RoundID, $Score)) {
        echo "Success";
        
    }        
}

