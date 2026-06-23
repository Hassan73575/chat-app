<?php include "dbconnect.php";
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
}
$current_userid = $_SESSION['id'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "navbar.php" ?>
    <?php
    $query = "SELECT * FROM `users` WHERE id = '$current_userid';";
    $exe = mysqli_query($conn, $query);
    $profile_data = mysqli_fetch_assoc($exe)
        ?>
    <div class="msgx-profile-wrapper">

        <div class="msgx-profile-card">

            <div class="msgx-profile-cover"></div>

            <div class="msgx-profile-info">
                <img src="profile_pics/<?php echo $profile_data["profilepic"] ?>" class="msgx-profile-avatar">

                <h2 class="msgx-profile-name">Username</h2>
                <h6 ><?php echo $profile_data['username']; ?></h6>
                <div class="msgx-profile-stats">

                    <div>
                        <strong>Bio</strong>
                        <h6><?php echo $profile_data['bio']; ?></h6>
                    </div>
                </div>

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
                    <button class="btn btn-danger" onclick="logout()">Logout <i
                            class="fa-solid fa-arrow-right-from-bracket"></i></button>

                </div>

            </div>

        </div>

    </div>
    <script src="chat.js"></script>
    <?php include "footer.php" ?>

</body>

</html>