<?php
include_once("../Round.php");


if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    
    // Get round with round id
    if(!empty($_GET["id"])) {
        $round = Round::GetRoundWithID($_GET["id"]);
        echo json_encode($round);
    }
    // Get rounds for event
    else if(!empty($_GET["eventid"])) {
        $rounds = Round::GetRoundsWithEventID($_GET["eventid"]);
        echo json_encode($rounds);
    }
    // Get all rounds
    else {
        $rounds = Round::GetAllRounds();
        echo json_encode($rounds);
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

