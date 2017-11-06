<?php
include_once("../Event.php");


if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    if(!empty($_GET["id"])) {
        $event = Event::GetEventWithID($_GET["id"]);
        echo json_encode($event);
    }
    // Upcomming and Joined
    else if(!empty($_GET["userid"]) && !empty($_GET["upcomingandjoined"])) {
        $events = Event::GetUpcomingAndJoinedEventsWithUserID($_GET["userid"]);
        echo json_encode($events);        
    }
    // Upcomming, Joined and Past
    else if(!empty($_GET["userid"]) && !empty($_GET["allevents"])) {
        $events = Event::GetAllEventsWithUserID($_GET["userid"]);
        echo json_encode($events); 
    }
    // Completed
    else if(!empty($_GET["userid"]) && !empty($_GET["completed"])) {
        $events = Event::GetCompletedEventsWithUserID($_GET["userid"]);
        echo json_encode($events); 
    }
    else if(!empty($_GET["userid"])) {
        $events = Event::GetEventsWithUserID($_GET["userid"]);
        echo json_encode($events);
    }
    else {
        $events = Event::GetAllEvents();
        echo json_encode($events);
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    
    if(!empty($_POST["userid"]) && !empty($_POST["eventid"]) && !empty($_POST["entryfee"])) {
        if(Event::UserJoinedEvent($_POST["userid"], $_POST["eventid"], $_POST["entryfee"])) {
            echo "Success";
        }
        else {
            echo 'Failure';
        }
    }
        
        
}
