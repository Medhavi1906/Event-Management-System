<?php
session_start();
include("db.php");

// Only admin allowed
if($_SESSION['user']['role'] != 'admin'){
    echo "Access Denied";
    exit();
}

$event_id = $_GET['id'];

// Get event name
$event = $conn->query("SELECT * FROM events WHERE id=$event_id")->fetch_assoc();

// Get registered users
$result = $conn->query("
    SELECT users.name, users.email 
    FROM registrations 
    JOIN users ON registrations.user_id = users.id
    WHERE registrations.event_id = $event_id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Registrations</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: url('abc.jpg') center/cover;
}
.overlay{
    position:fixed;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.6);
}
.container{
    position:relative;
    z-index:1;
}
</style>
</head>

<body>

<div class="overlay"></div>

<div class="container mt-5 text-white">

<h2><?php echo $event['title']; ?> - Registrations</h2>

<table class="table table-dark table-striped mt-4">
<tr>
<th>Name</th>
<th>Email</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
</tr>
<?php } ?>

</table>

<a href="events.php" class="btn btn-light">Back</a>

</div>

</body>
</html>
