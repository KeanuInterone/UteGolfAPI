<?php
include_once("../Event.php");


if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    if(!empty($_GET["eventid"])) {
        $event = Event::GetEventWithID($_GET["eventid"]);
        echo json_encode($event);
    }
    else if(!empty($_GET["userid"]) && !empty($_GET["upcommingandjoined"])) {
        $events = Event::GetUpcommingAndJoinedEventsForUserID($_GET["userid"]);
        echo json_encode($events); 
    }
    else if(!empty($_GET["userid"])) {
        $events = Event::GetEventsForUserWithID($_GET["userid"]);
        echo json_encode($events);
    }
    else {
        $events = Event::GetAllEvents();
        echo json_encode($events);
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    	$UserID = $_POST["userid"];
	$EventID = $_POST["eventid"];
        $EntryFee = $_POST["entryfee"];
        
        if(Event::UserJoinedEvent($UserID, $EventID, $EntryFee)) {
            echo "Success";
        }
        else {
            echo 'Failure';
        }
}
