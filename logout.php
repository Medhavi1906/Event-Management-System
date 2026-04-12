
<head>
    <title>Event Management System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
session_start();
session_destroy();
header("Location: login.php");
?>
