<?php
session_start();
include("db.php");

$result = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
<title>Events</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* 🔥 Background */
body{
    background:url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30') no-repeat center/cover;
    position: relative;
}

/* 🔥 Overlay */
body::before{
    content:'';
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    z-index:0;
}

/* Keep content above overlay */
body > *{
    position:relative;
    z-index:1;
}

/* 🔥 Card Layout */
.card{
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-radius: 15px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    color:white;
    border: 1px solid rgba(255,255,255,0.2);
    transition: 0.3s ease;
}
.card h5, .card p{
    color:white;
}

/* Hover Effect */
.card:hover{
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

/* Card Body */
.card-body{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Fix text */
.card p, .card h5{
    word-wrap: break-word;
}

/* Buttons */
.card .btn{
    margin-top: auto;
}

/* Button hover */
.btn{
    transition: 0.3s;
}
.btn:hover{
    transform: scale(1.05);
}

/* Spacing */
.row{
    row-gap: 20px;
}

</style>
</head>

<body>

<?php include("navbar.php"); ?>

<div class="container mt-5">
<div class="row">

<?php while($row = $result->fetch_assoc()){ ?>

<div class="col-md-4">

<div class="card mb-4 shadow">
    <img src="https://source.unsplash.com/400x250/?event" class="card-img-top">

    <div class="card-body">

        <div>
            <h5><?php echo $row['title']; ?></h5>
            <p><?php echo $row['description']; ?></p>
            <p><b>Date:</b> <?php echo $row['date']; ?></p>
            <p><b>Time:</b> <?php echo date("h:i A", strtotime($row['time'])); ?></p>
            <p><b>Location:</b> <?php echo $row['location']; ?></p>
        </div>

        <div>

            <!-- Register Button -->
            <a href="register_event.php?id=<?php echo $row['id']; ?>" 
               class="btn btn-primary w-100 mb-2">
               Register
            </a>

            <!-- ADMIN FEATURES -->
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){ ?>

            <!-- Delete -->
            <a href="delete_event.php?id=<?php echo $row['id']; ?>" 
               class="btn btn-danger w-100 mb-2"
               onclick="return confirm('Delete this event?')">
               Delete
            </a>

            <!-- Registration Count -->
            <?php
            $count = $conn->query("SELECT COUNT(*) as total FROM registrations WHERE event_id=".$row['id'])->fetch_assoc();
            ?>
            <p><b>Registered:</b> <?php echo $count['total']; ?></p>

            <!-- View Users -->
            <a href="view_registrations.php?id=<?php echo $row['id']; ?>" 
               class="btn btn-dark w-100">
               View Registrations
            </a>

            <?php } ?>

        </div>

    </div>
</div>

</div>

<?php } ?>

</div>
</div>

</body>
</html>
