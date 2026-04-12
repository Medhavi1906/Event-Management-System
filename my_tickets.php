<?php
session_start();
include("db.php");

$user_id = $_SESSION['user']['id'];

$result = $conn->query("
    SELECT events.* 
    FROM registrations 
    JOIN events ON registrations.event_id = events.id 
    WHERE registrations.user_id = '$user_id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Tickets</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* 🔥 THEME BACKGROUND (EVENT STYLE) */
body{
    background: url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30') no-repeat center center fixed;
    background-size: cover;
}

/* 🔥 DARK OVERLAY */
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
.container{
    position: relative;
    z-index:1;
}

/* 🔥 CARD FIX */
.card{
    border-radius:15px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    color:white;
    border: 1px solid rgba(255,255,255,0.2);
    transition: 0.3s;
    height: 100%;
    overflow: hidden;
}

.card h5, .card p{
    color:white;
}
.card:hover{
    transform: scale(1.02);
}

/* 🔥 TEXT FIX (no overflow) */
.card h5, .card p{
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* 🔥 BUTTON FIX */
.btn{
    white-space: nowrap;
}

/* 🔥 MOBILE FIX */
@media(max-width:768px){
    .text-end{
        text-align:left !important;
        margin-top:10px;
    }
}

</style>
</head>

<body>

<div class="overlay"></div>

<?php include("navbar.php"); ?>

<div class="container mt-5">

<h3 class="text-white mb-4">My Tickets</h3>

<div class="row g-4">

<?php while($row = $result->fetch_assoc()){ ?>

<div class="col-md-6 col-12">

<div class="card shadow p-3">

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start">

    <!-- Event Info -->
    <div style="flex:1;">
        <h5><?php echo $row['title']; ?></h5>
        <p><?php echo $row['description']; ?></p>
        <p><b>Date:</b> <?php echo $row['date']; ?></p>
        <p><b>Time:</b> <?php echo date("h:i A", strtotime($row['time'])); ?></p>
        <p><b>Location:</b> <?php echo $row['location']; ?></p>
    </div>

    <!-- Button -->
    <div class="mt-3 mt-md-0 ms-md-3" style="min-width:150px;">
        <a href="cancel_registration.php?id=<?php echo $row['id']; ?>" 
           class="btn btn-danger w-100"
           onclick="return confirm('Cancel this registration?')">
           Cancel
        </a>
    </div>

</div>

</div>

</div>

<?php } ?>

</div>
</div>

</body>
</html>
