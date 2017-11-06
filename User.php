<?php
include_once("DatabaseConnection.php");

class User {
	
    public $UserID = 0;
    public $IsAdmin = flase;
    public $FirstName = "";
    public $LastName = "";
    public $Login = "";
    public $Password = "";
    public $UtePoints = 0.0;

    public static function GetAllUsers() {
        $connection = DatabaseConnection::getConnection();

        $query = "SELECT UserID, IsAdmin, FirstName, LastName, Login, UtePoints "
                . "FROM Users;";

        // execute the query
        $result = $connection->query($query);
        $connection->close();

        // collet the data we get back
        if ($result->num_rows > 0) {
            $users = array();
            while($row = $result->fetch_assoc()) {
                array_push($users, $row);
            }
            return $users;
        }
        else {
            return null;
        }

    }

    public static function GetUserWithID($UserID) {

        $connection = DatabaseConnection::getConnection();

        $query = "SELECT UserID, IsAdmin, FirstName, LastName, Login, UtePoints "
                . "FROM Users "
                . "WHERE UserID = {$UserID};";

        // execute the query
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

    public static function Login($login, $password)
    {   
        $connection = DatabaseConnection::getConnection();

        $query = "SELECT UserID, IsAdmin, FirstName, LastName, Login, UserPassword, UtePoints "
                . "FROM Users "
                . "WHERE Login = '{$login}';";

        // execute the query
        $result = $connection->query($query);
        $connection->close();

        // collet the data we get back
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            if ($password == $row["UserPassword"])
            {
                return $row;
            }
            else {
                return null;
            }
        } 
        else {
            return null;
        }		  
    }
    
    
    public static function AddUser($IsAdmin, $FirstName, $LastName, $Login, $Password) {
        
        $connection = DatabaseConnection::getConnection();
        
        $IsAdminInt = 0;
        if($IsAdmin) {
            $IsAdminInt = 1;
        }
        
        $query = "INSERT INTO Users(IsAdmin, FirstName, LastName, Login, UserPassword) "
                . "VALUES({$IsAdminInt}, '{$FirstName}', '{$LastName}', '{$Login}', '{$Password}');";
        
        if ($connection->query($query)) {
            $connection->close();
            return true;
        }
        else {
            $connection->close();
            return false;
        } 
        
    }
    
}
	
