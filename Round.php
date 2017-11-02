<?php
include 'DatabaseConnection.php';

class Round {
    
    public static function GetAllRounds() {  
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "select * from Rounds;";
        
        $result = $connection->query($query);
        $connection->close();

        // collet the data we get back
        if ($result->num_rows > 0) {
            $rounds = array();
            while($row = $result->fetch_assoc()) {
                array_push($rounds, $row);
            }
            return $rounds;
        } 
        else {
            return null;
        }
    }
    
    public static function GetRoundWithID($RoundID) {
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT * FROM Rounds WHERE RoundID = {$RoundID}";
        
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
    
    public static function GetRoundsWithEventID($EventID) {
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT * "
                . "FROM Rounds "
                . "WHERE EventID = {$EventID};";
        
        $result = $connection->query($query);
        $connection->close();
        
        // collet the data we get back
        if ($result->num_rows > 0) {
            $rounds = array();
            while($row = $result->fetch_assoc()) {
                array_push($rounds, $row);
            }
            return $rounds;
        } 
        else {
            return null;
        } 
    }
    
}

