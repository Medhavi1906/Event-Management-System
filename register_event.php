<?php
session_start();
include("db.php");

$user_id = $_SESSION['user']['id'];
$event_id = $_GET['id'];

$check = $conn->query("SELECT * FROM registrations WHERE user_id='$user_id' AND event_id='$event_id'");

if($check->num_rows == 0){
    $conn->query("INSERT INTO registrations(user_id,event_id)
                  VALUES('$user_id','$event_id')");
}

header("Location: my_tickets.php");
