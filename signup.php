<?php
include "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Sign Up</h1>
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="Bio" class="form-label">Bio</label>
                <input type="text" class="form-control" id="Bio" name="bio" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="profilepic" class="form-label">Profile pic</label>
                <input type="file" class="form-control" id="profilepic" name="profilepic" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
            <div class="mb-3">
                <label for="profilepic" class="form-label">Already Signup?</label>
                <a class="" href="login.php">login</a>
            </div>
        </form>
    </div>

</body>

</html>
<?php
include "dbconnect.php";

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $bio = $_POST["bio"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $pfp = $_FILES['profilepic']['name'];
    $tmp = $_FILES['profilepic']['tmp_name'];


    move_uploaded_file($tmp, "profile_pics/" . $pfp);

    $query = "INSERT INTO `users`(`username`, `email`, `bio`, `password`, `profilepic`) VALUES ('$username','$email','$bio','$hashedPassword','$pfp')";
    $exe = mysqli_query($conn, $query);

    if ($exe) {
        echo "<script> alert('User registered successfully')</script>";
    } else {
        echo "<script> alert('Failed to register user')
        windows.location.href ='index.php';
        </script>";
    }
}
?>