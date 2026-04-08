<?php
session_start();
include("db.php");

// Only admin allowed
if($_SESSION['user']['role'] != 'admin'){
    echo "Access Denied";
    exit();
}

if(isset($_POST['create'])){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $loc = $_POST['location'];

    if($conn->query("INSERT INTO events(title,description,date,time,location)
        VALUES('$title','$desc','$date','$time','$loc')")){
        
        $success = true; // flag for popup
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- 🔥 SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body{
    background:url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d') center/cover;
    position: relative;
}

/* Overlay */
body::before{
    content:'';
    position:fixed;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    z-index:0;
}

/* Content above overlay */
body > *{
    position:relative;
    z-index:1;
}

/* Card */
.card{
    border-radius:15px;
    background: rgba(255,255,255,0.95);
}
</style>

</head>

<body>

<?php include("navbar.php"); ?>

<div class="container mt-5">
<div class="card p-4 shadow">

<h3>Create Event</h3>

<form method="POST">

<label><b>Event Title</b></label>
<input type="text" name="title" class="form-control mb-3" placeholder="Enter event title" required>

<label><b>Description</b></label>
<textarea name="description" class="form-control mb-3" placeholder="Enter event description" required></textarea>

<label><b>Date</b></label>
<input type="date" name="date" class="form-control mb-3" required>

<label><b>Time</b></label>
<input type="time" name="time" class="form-control mb-3" required>

<label><b>Location</b></label>
<input type="text" name="location" class="form-control mb-3" placeholder="Enter event location" required>

<button name="create" class="btn btn-success w-100">Create Event</button>

</form>

</div>
</div>

<!-- 🔥 POPUP AFTER PAGE LOAD -->
<?php if(isset($success)){ ?>
<script>
Swal.fire({
    title: 'Success!',
    text: 'Event Created Successfully',
    icon: 'success',
    confirmButtonColor: '#28a745'
});
</script>
<?php } ?>

</body>
</html>
