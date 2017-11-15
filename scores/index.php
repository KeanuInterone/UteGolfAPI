<?php
include_once("../Score.php");


if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    
    // Get score with id
    if(!empty($_GET["id"])) {
        $score = Score::GetScoreWithID($_GET["id"]);
        echo json_encode($score);
    }
    // Get get score for round with user and round id
    else if(!empty($_GET["userid"]) && !empty($_GET["roundid"])) {
        $score = Score::GetScoreForUserForRoundWithIDs($_GET["userid"], $_GET["roundid"]);
        echo json_encode($score);
    }
    // Get all scores
    else {
        $scores = Score::GetAllScores();
        echo json_encode($scores);
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    // record a score
    if(!empty($_POST["userid"]) && !empty($_POST["roundid"]) && !empty($_POST["score"])) {
        if(Score::RecordScore($_POST["userid"], $_POST["roundid"], $_POST["score"])) {
            echo "Success";
        }
        else {
            echo 'Failure';
        }
    }
        
        
}

