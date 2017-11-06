<?php
include_once("DatabaseConnection.php");

class Score {
    
    
    public static function GetAllScores() {  
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "select * from Scores;";
        
        $result = $connection->query($query);
        $connection->close();

        // collet the data we get back
        if ($result->num_rows > 0) {
            $scores = array();
            while($row = $result->fetch_assoc()) {
                array_push($scores, $row);
            }
            return $scores;
        } 
        else {
            return null;
        }
    }
    
    public static function GetScoreWithID($ScoreID) {
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT * FROM Scores WHERE ScoreID = {$ScoreID}";
        
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
    
    public static function GetScoreForUserForRoundWithIDs($UserID, $RoundID) {
        
        $connection = DatabaseConnection::getConnection();
        
        $query = "SELECT * "
                . "FROM Scores "
                . "WHERE RoundID = {$RoundID} "
                . "AND UserID = {$UserID}; ";
        
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
}