<?php
session_start();
include("db.php");

$selected_role = $_GET['role'] ?? '';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $result = $conn->query("SELECT * FROM users 
        WHERE email='$email' AND password='$password' AND role='$role'");

    if($result->num_rows > 0){
        $_SESSION['user'] = $result->fetch_assoc();
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30') center/cover;
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
.glass{
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    color:white;
    border-radius:15px;
}
</style>
</head>

<body>

<div class="overlay"></div>

<div class="d-flex justify-content-center align-items-center vh-100 container-box">

<div class="glass p-4 shadow" style="width:350px;">

<h3 class="text-center">Login</h3>
<p class="text-center">Login as <?php echo ucfirst($selected_role); ?></p>

<?php if(isset($error)){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input type="hidden" name="role" value="<?php echo $selected_role; ?>">

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button name="login" class="btn btn-danger w-100">Login</button>

</form>

<div class="text-center mt-3">
    <a href="register.php?role=<?php echo $selected_role; ?>" class="text-white">
        Create New Account
    </a>
</div>

</div>
</div>

</body>
</html>
