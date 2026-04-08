<?php
session_start();
include("db.php");

$user_id = $_SESSION['user']['id'];
$event_id = $_GET['id'];

// Delete registration
$conn->query("DELETE FROM registrations 
              WHERE user_id=$user_id AND event_id=$event_id");

// Redirect back
header("Location: my_tickets.php");
exit();
?>
