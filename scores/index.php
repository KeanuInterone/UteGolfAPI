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

