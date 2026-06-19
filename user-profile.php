<?php include "dbconnect.php";
     session_start();
     if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
}
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="chat.css">
</head>
<body>
    <?php include "navbar.php"?>
    <div class="msgx-profile-wrapper">

    <div class="msgx-profile-card">

        <div class="msgx-profile-cover"></div>

        <div class="msgx-profile-info">
            <img src="avatar.jpg" alt="Profile" class="msgx-profile-avatar">

            <h2 class="msgx-profile-name"><?php echo $_SESSION['username']?></h2>


            <div class="msgx-profile-stats">
                <div>
                    <strong>245</strong>
                    <span>Friends</span>
                </div>

                <div>
                    <strong>89</strong>
                    <span>Groups</span>
                </div>
            </div>

            <div class="msgx-profile-actions">
                <button class="btn btn-danger" onclick="logout()">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                
            </div>

        </div>

    </div>

</div>
<script src="chat.js"></script>
    
</body>
</html>