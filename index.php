<!DOCTYPE html>
<html>
<head>
<title>Select Role</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: url('em.jpg') no-repeat center center/cover;
    height:100vh;
    position: relative;
}

/* Overlay */
body::before{
    content:'';
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    z-index:0;
}

/* Content above */
body > *{
    position:relative;
    z-index:1;
}

/* Glass Card */
.glass{
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius:15px;
    color:white;
}
</style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center vh-100">

<div class="glass p-5 text-center shadow" style="width:350px;">

<h2 class="mb-4">Login As</h2>

<a href="login.php?role=admin" class="btn btn-dark mb-3 w-100">
👨‍💼 Login as Admin
</a>

<a href="login.php?role=user" class="btn btn-success w-100">
👤 Login as User
</a>

</div>

</div>

</body>
</html>
