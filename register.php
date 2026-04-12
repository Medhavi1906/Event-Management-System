<?php
include("db.php");

$role = $_GET['role'] ?? 'user';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $conn->query("INSERT INTO users(name,email,password,role)
                  VALUES('$name','$email','$password','$role')");

    echo "<script>
    alert('Account Created Successfully!');
    window.location='login.php?role=$role';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d') center/cover;
}
.overlay{
    position:fixed;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.6);
}
.container-box{
    position:relative;
    z-index:1;
}
.card{
    border-radius:15px;
}
</style>
</head>

<body>

<div class="overlay"></div>

<div class="d-flex justify-content-center align-items-center vh-100 container-box">

<div class="card p-4 shadow" style="width:350px;">

<h3 class="text-center">Register</h3>
<p class="text-center">As <?php echo ucfirst($role); ?></p>

<form method="POST">

<input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button name="register" class="btn btn-success w-100">Register</button>

</form>

<div class="text-center mt-3">
    <a href="login.php?role=<?php echo $role; ?>">Back to Login</a>
</div>

</div>
</div>

</body>
</html>
