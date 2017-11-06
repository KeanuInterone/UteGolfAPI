<?php
include_once("../User.php");

if($_SERVER['REQUEST_METHOD'] == "GET") {
    
    if(!empty($_GET["id"])) {
        $user = User::GetUserWithID($_GET["id"]);
        echo json_encode($user); 
    } 
    else {
        $users = User::GetAllUsers();
        echo json_encode($users);
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    if(!empty($_POST["isadmin"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["login"]) && !empty($_POST["password"])) {
        $isAdminBool = false;
        if($_POST["isadmin"] == "true") {
            $isAdminBool = true;
        }
        if(User::AddUser($isAdminBool, $_POST["firstname"], $_POST["lastname"], $_POST["login"], $_POST["password"])) {
            echo "Success";
        }
        else {
            echo "Failure";
        }
    }
    else if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $user = User::Login($_POST["username"], $_POST["password"]);
        echo json_encode($user);
    }
    
}
