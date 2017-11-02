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

	$user = User::Login($_POST["username"], $_POST["password"]);
	echo json_encode($user);
}
