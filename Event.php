<?php
include 'DatabaseConnection.php';

class Event {
    
    public $EventID = 0;
    public $IsOpen = false;
    public $EventName = "";
    public $EntryFee = 0.0;
    
    public static function GetAllEvents() {  
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "select * from Events;";
        
        $result = $connection->query($query);
        $connection->close();

        // collet the data we get back
        if ($result->num_rows > 0) {
            $events = array();
            while($row = $result->fetch_assoc()) {
                array_push($events, $row);
            }
            return $events;
        } 
        else {
            return null;
        }
    }
    
    public static function GetEventWithID($EventID) {
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT * FROM Events WHERE EventID = {$EventID}";
        
        $result = $connection->query($query);
        $connection->close();

        // collet the data we get back
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } 
        else {
            return null;
        }
    }
    
    public static function GetEventsWithUserID($UserID) {
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT e.EventID, e.IsOpen, e.EventName, e.EntryFee, u.HasCompleted "
                . "FROM UserEvents u "
                . "    INNER JOIN Events e "
                . "        ON u.EventID = e.EventID "
                . "WHERE u.UserID = {$UserID};";
        
        $result = $connection->query($query);
        $connection->close();
        
        if ($result->num_rows > 0) {
            $events = array();
            while($row = $result->fetch_assoc()) {
                array_push($events, $row);
            }
            return $events;
        } 
        else {
            return null;
        }
        
    }

    public static function GetUpcomingAndJoinedEventsWithUserID($UserID) {
        $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT e.EventID, e.IsOpen, e.EventName, e.EntryFee, u.HasCompleted "
                . "FROM Events e "
                . "     LEFT JOIN UserEvents u "
                . "         ON ((e.EventID = u.EventID) "
                . "         AND (u.UserID = {$UserID}) "
                . "         AND (u.HasCompleted = 0)) "
                . "WHERE e.IsOpen = 1;";

        $result = $connection->query($query);
        $connection->close();
        
        if ($result->num_rows > 0) {
            $events = array();
            while($row = $result->fetch_assoc()) {
                array_push($events, $row);
            }
            return $events;
        } 
        else {
            return null;
        } 
    }
    
    public static function GetAllEventsWithUserID($UserID) {
                $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT e.EventID, e.IsOpen, e.EventName, e.EntryFee, u.HasCompleted "
                . "FROM Events e "
                . "     LEFT JOIN UserEvents u "
                . "         ON ((e.EventID = u.EventID) "
                . "         AND (u.UserID = {$UserID}));";

        $result = $connection->query($query);
        $connection->close();
        
        if ($result->num_rows > 0) {
            $events = array();
            while($row = $result->fetch_assoc()) {
                array_push($events, $row);
            }
            return $events;
        } 
        else {
            return null;
        }
    }
    
        public static function GetCompletedEventsWithUserID($UserID) {
        $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT e.EventID, e.IsOpen, e.EventName, e.EntryFee, u.HasCompleted "
                . "FROM Events e "
                . "     INNER JOIN UserEvents u "
                . "         ON ((e.EventID = u.EventID) "
                . "         AND (u.UserID = {$UserID}) "
                . "         AND (u.HasCompleted = 1));";

        $result = $connection->query($query);
        $connection->close();
        
        if ($result->num_rows > 0) {
            $events = array();
            while($row = $result->fetch_assoc()) {
                array_push($events, $row);
            }
            return $events;
        } 
        else {
            return null;
        } 
    }
    
    public static function CreateEvent($EventName, $EntryFee) {
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "INSERT into Events(EventName, EntryFee) "
                . "VALUES('{$EventName}', {$EntryFee});";
        
        if ($connection->query($query)) {
            $connection->close();
            return true;
        }
        else {
            $connection->close();
            return false;
        } 
        
    }
    
    public static function UserJoinedEvent($UserID, $EventID) {
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "INSERT INTO UserEvents(UserID, EventID) "
                . "VALUES({$UserID}, {$EventID}); "
                . ""
                . "UPDATE Users u "
                . "SET u.UtePoints = u.UtePoints - (SELECT EntryFee FROM Events WHERE EventID = {$EventID}) "
                . "WHERE u.UserID = {$UserID};";
        
        if ($connection->multi_query($query)) {
            $connection->close();
            return true;
        }
        else {
            $connection->close();
            return false;
        } 
        
    }
    
}



