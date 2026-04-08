<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* 🔥 CUSTOM BACKGROUND */
body{
    background: url('abc.webp') no-repeat center center fixed;
    background-size: cover;
}

/* 🔥 OVERLAY */
.overlay{
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
    z-index:0;
}

/* Content above overlay */
.content{
    position: relative;
    z-index:1;
}

/* 🔥 CARD DESIGN */
.card{
    border-radius:15px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    color:white;
    transition: 0.3s;
}

.card:hover{
    transform: scale(1.05);
}

/* Title */
h1{
    font-weight: bold;
}

/* Row width control */
.custom-row{
    max-width: 900px;
    width:100%;
}

/* Mobile fix */
@media(max-width:768px){
    .custom-row{
        max-width:100%;
    }
}

</style>
</head>

<body>

<div class="overlay"></div>

<?php include("navbar.php"); ?>

<div class="content d-flex flex-column justify-content-center align-items-center vh-100 text-center">

<h1 class="text-white mb-5">
    Welcome <?php echo $_SESSION['user']['name']; ?>
</h1>

<div class="row justify-content-center custom-row">

    <!-- View Events -->
    <div class="col-md-4 col-12 mb-4">
        <div class="card p-4 shadow">
            <h4>🎉 View Events</h4>
            <a href="events.php" class="btn btn-primary mt-3">Go</a>
        </div>
    </div>

    <!-- My Tickets -->
    <div class="col-md-4 col-12 mb-4">
        <div class="card p-4 shadow">
            <h4>🎟️ My Tickets</h4>
            <a href="my_tickets.php" class="btn btn-warning mt-3">Go</a>
        </div>
    </div>

    <!-- ADMIN ONLY -->
    <?php if($_SESSION['user']['role'] == 'admin'){ ?>
    <div class="col-md-4 col-12 mb-4">
        <div class="card p-4 shadow">
            <h4>➕ Create Event</h4>
            <a href="create_event.php" class="btn btn-success mt-3">Go</a>
        </div>
    </div>
    <?php } ?>

</div>

</div>

</body>
</html>
