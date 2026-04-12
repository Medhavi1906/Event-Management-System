<?php
session_start();
include("db.php");

// Only admin allowed
if($_SESSION['user']['role'] != 'admin'){
    echo "Access Denied";
    exit();
}

$id = $_GET['id'];

// First delete registrations (IMPORTANT to avoid error)
$conn->query("DELETE FROM registrations WHERE event_id=$id");

// Then delete event
$conn->query("DELETE FROM events WHERE id=$id");

// Redirect back
header("Location: events.php");
exit();
?>
